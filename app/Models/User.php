<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // ... (kode yang sudah ada)

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin()
    {
        return $this->role && $this->role->role_name === 'Admin';
    }

    /**
     * Check if user is a resident.
     */
    public function isResident()
    {
        return $this->role && $this->role->role_name === 'Resident';
    }
}