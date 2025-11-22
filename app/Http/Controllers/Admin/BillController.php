<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Resident;
use App\Models\Payment;
use Illuminate\Http\Request;

class BillController extends Controller
{
    // Daftar Tagihan
    public function index()
    {
        // Load relasi payment juga untuk melihat bukti
        $bills = Bill::with(['resident.user', 'resident.unit', 'payment'])->latest()->paginate(10);
        return view('admin.bills.index', compact('bills'));
    }

    public function create()
    {
        $residents = Resident::with('user', 'unit')->where('status', 'Aktif')->get();
        return view('admin.bills.create', compact('residents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'month' => 'required',
            'year' => 'required',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        $monthString = $request->month . ' ' . $request->year;

        Bill::create([
            'resident_id' => $request->resident_id,
            'month' => $monthString,
            'amount' => $request->amount,
            'due_date' => $request->due_date,
            'status' => 'Belum Dibayar',
        ]);

        return redirect()->route('admin.bills.index')->with('success', 'Tagihan berhasil dibuat!');
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('admin.bills.index')->with('success', 'Tagihan dihapus.');
    }

    /**
     * Konfirmasi Pembayaran (Terima/Tolak) - FITUR BARU
     */
    public function confirmPayment(Request $request, Bill $bill)
    {
        $request->validate([
            'action' => 'required|in:accept,reject',
            'admin_note' => 'nullable|string', // Catatan wajib jika ditolak
        ]);

        $payment = $bill->payment;

        if (!$payment) {
            return back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        if ($request->action == 'accept') {
            // TERIMA: Tagihan Lunas, Payment Dikonfirmasi
            $bill->update(['status' => 'Lunas']);
            $payment->update(['status' => 'Dikonfirmasi']);
            $message = 'Pembayaran berhasil dikonfirmasi. Status tagihan LUNAS.';
        } else {
            // TOLAK: Tagihan balik jadi Belum Dibayar, Payment Ditolak + Catatan
            $bill->update(['status' => 'Belum Dibayar']); 
            $payment->update([
                'status' => 'Ditolak',
                'admin_note' => $request->admin_note
            ]);
            $message = 'Pembayaran ditolak. Penghuni diminta upload ulang.';
        }

        return back()->with('success', $message);
    }
}