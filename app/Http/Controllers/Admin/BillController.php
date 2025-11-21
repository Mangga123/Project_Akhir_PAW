<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Resident;
use Illuminate\Http\Request;

class BillController extends Controller
{
    // Daftar Tagihan
    public function index()
    {
        $bills = Bill::with('resident.user', 'resident.unit')->latest()->paginate(10);
        return view('admin.bills.index', compact('bills'));
    }

    // Form Buat Tagihan
    public function create()
    {
        // Ambil penghuni yang aktif saja
        $residents = Resident::with('user', 'unit')->where('status', 'Aktif')->get();
        return view('admin.bills.create', compact('residents'));
    }

    // Simpan Tagihan
    public function store(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'month' => 'required', // Contoh: "November 2025"
            'year' => 'required',  // Tambahan untuk helper visual
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        // Gabungkan Bulan dan Tahun biar rapi (Opsional, atau simpan string saja)
        $monthString = $request->month . ' ' . $request->year;

        Bill::create([
            'resident_id' => $request->resident_id,
            'month' => $monthString,
            'amount' => $request->amount,
            'due_date' => $request->due_date,
            'status' => 'Belum Dibayar', // Default status
        ]);

        return redirect()->route('admin.bills.index')->with('success', 'Tagihan berhasil dibuat!');
    }

    // Hapus Tagihan
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('admin.bills.index')->with('success', 'Tagihan dihapus.');
    }
}