<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    /**
     * Tampilkan daftar penghuni.
     */
    public function index()
    {
        // Ambil data resident beserta relasi user dan unitnya
        $residents = Resident::with(['user', 'unit'])->latest()->paginate(10);
        return view('admin.residents.index', compact('residents'));
    }

    /**
     * Form tambah penghuni.
     */
    public function create()
    {
        // Ambil user yang role-nya 'Resident' (Warga)
        // Asumsi: Role ID 2 adalah Resident (sesuai seeder)
        // Atau lebih aman pakai whereHas kalau relasi role sudah beres
        $users = User::whereHas('role', function($q) {
            $q->where('role_name', 'Resident');
        })->get();

        // Ambil semua unit untuk dipilih
        $units = Unit::all();

        return view('admin.residents.create', compact('users', 'units'));
    }

    /**
     * Simpan data penghuni baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'unit_id' => 'required|exists:units,id',
            'start_date' => 'required|date',
            'status' => 'required',
        ]);

        // Update status unit jadi 'Terisi' otomatis
        $unit = Unit::find($request->unit_id);
        $unit->update(['status' => 'Terisi']);

        Resident::create($request->all());

        return redirect()->route('admin.residents.index')
            ->with('success', 'Penghuni berhasil ditambahkan!');
    }

    /**
     * Form edit penghuni.
     */
    public function edit(Resident $resident)
    {
        $users = User::whereHas('role', function($q) {
            $q->where('role_name', 'Resident');
        })->get();
        
        $units = Unit::all();

        return view('admin.residents.edit', compact('resident', 'users', 'units'));
    }

    /**
     * Update data penghuni.
     */
    public function update(Request $request, Resident $resident)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'unit_id' => 'required|exists:units,id',
            'start_date' => 'required|date',
            'status' => 'required',
        ]);

        // Jika pindah unit, unit lama jadi kosong, unit baru jadi terisi
        if ($resident->unit_id != $request->unit_id) {
            Unit::find($resident->unit_id)->update(['status' => 'Kosong']);
            Unit::find($request->unit_id)->update(['status' => 'Terisi']);
        }

        $resident->update($request->all());

        return redirect()->route('admin.residents.index')
            ->with('success', 'Data penghuni berhasil diperbarui!');
    }

    /**
     * Hapus data penghuni.
     */
    public function destroy(Resident $resident)
    {
        // Unit yang ditinggalkan jadi Kosong
        $resident->unit->update(['status' => 'Kosong']);
        
        $resident->delete();

        return redirect()->route('admin.residents.index')
            ->with('success', 'Data penghuni berhasil dihapus!');
    }
}