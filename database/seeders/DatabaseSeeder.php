<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT ROLES (Penting untuk hak akses)
        $roleAdmin = Role::create(['role_name' => 'Admin']);
        $roleResident = Role::create(['role_name' => 'Resident']); // Penghuni
        $roleStaff = Role::create(['role_name' => 'Staff']);

        // 2. BUAT USER ADMIN (Agar kamu bisa login nanti)
        User::create([
            'role_id' => $roleAdmin->id, // Link ke Role Admin di atas
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com', // Email untuk login
            'password' => Hash::make('password'), // Passwordnya: password
            'phone' => '081234567890',
        ]);

        // 3. BUAT BEBERAPA UNIT APARTEMEN (Contoh Data)
        Unit::create([
            'unit_number' => 'A-101',
            'tower' => 'Tower A',
            'floor' => 1,
            'type' => 'Studio',
            'status' => 'Kosong',
        ]);

        Unit::create([
            'unit_number' => 'B-205',
            'tower' => 'Tower B',
            'floor' => 2,
            'type' => '2BR', // 2 Kamar
            'status' => 'Terisi',
        ]);
        
        Unit::create([
            'unit_number' => 'C-512',
            'tower' => 'Tower C',
            'floor' => 5,
            'type' => '1BR', 
            'status' => 'Maintenance',
        ]);
    }
}