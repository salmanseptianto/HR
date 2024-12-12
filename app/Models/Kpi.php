<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jabatan',
        'desc',
        'bobot',
        'month',
        'year',
        'target',
        'realisasi',
        'skor',
        'final_skor'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
