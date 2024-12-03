<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harian extends Model
{
    use HasFactory;

    protected $table = 'harian';

    protected $fillable = ['id_marketing', 'date', 'project', 'nama', 'pekerjaan', 'alamat', 'prospek', 'foto', 'leads', 'aktivitas'];

    public function marketing()
    {
        return $this->belongsTo(User::class, 'id_marketing');
    }
}
