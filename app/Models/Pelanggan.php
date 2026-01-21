<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    /** @use HasFactory<\Database\Factories\PelangganFactory> */
    use HasFactory;

    //  protected $guarded = []; //artinya semua field boleh diisi massal
    protected $fillable = [
        'nama',
        'usia',
        'alamat',
    ];

    // --- INI NAMANYA LOCAL SCOPE ---
    // Naming convention: scopeNamaFitur
    public function scopeFilter($query, array $filters)
    {
        // Cek jika ada filter 'search'
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                // Saya bungkus dalam function($q) agar logika OR tidak bocor
                // Ini Best Practice untuk menghindari bug query di masa depan
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%');
            });
        });
    }
}
