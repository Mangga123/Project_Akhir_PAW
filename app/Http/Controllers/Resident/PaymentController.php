<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Payment;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Tampilkan daftar tagihan milik penghuni yang login.
     */
    public function index()
    {
        // Ambil data resident dari user yang login
        $resident = Resident::where('user_id', Auth::id())->first();

        // Jika belum jadi penghuni, kembalikan array kosong
        $bills = $resident 
            ? Bill::where('resident_id', $resident->id)->latest()->get()
            : collect();

        return view('resident.bills.index', compact('bills'));
    }

    /**
     * Tampilkan form upload bukti bayar untuk tagihan tertentu.
     */
    public function create(Bill $bill)
    {
        // Pastikan tagihan ini benar milik user yang login (Security)
        $resident = Resident::where('user_id', Auth::id())->firstOrFail();
        
        if ($bill->resident_id != $resident->id) {
            abort(403, 'Anda tidak berhak mengakses tagihan ini.');
        }

        return view('resident.payments.create', compact('bill'));
    }

    /**
     * Proses simpan pembayaran (Upload Bukti).
     */
    public function store(Request $request, Bill $bill)
    {
        $request->validate([
            'payment_date' => 'required|date',
            'proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
        ]);

        // Upload Bukti
        if ($request->hasFile('proof_image')) {
            $file = $request->file('proof_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('payments'), $filename);
        }

        // Simpan Data Pembayaran
        Payment::create([
            'bill_id' => $bill->id,
            'user_id' => Auth::id(),
            'payment_date' => $request->payment_date,
            'amount' => $bill->amount, // Asumsi bayar full
            'proof_image' => $filename,
            'status' => 'Pending', // Menunggu konfirmasi admin
        ]);

        // Update Status Tagihan jadi "Menunggu Konfirmasi"
        $bill->update(['status' => 'Menunggu Konfirmasi']);

        return redirect()->route('resident.bills.index')
            ->with('success', 'Bukti pembayaran berhasil dikirim! Tunggu konfirmasi admin.');
    }
}