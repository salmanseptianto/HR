<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mingguan extends Model
{
    use HasFactory;

    protected $table = 'mingguan';

     protected $fillable = [
        'id_marketing',
        'projectArea',
        'periode',
        'totalJumlahKanva',
        'jumlahKanvasTimSeminggu',
        'iklanOnline',
        'postingSosmed',
        'janjiTemuDanKunjungan',
        'calonKonsCekLokasi',
        'totalDataLeads',
        'dataProspek',
        'hotProspek',
        'booking',
        'pemberkasan',
        'closingAkadCash',
        'rencanaTargetClosingDalam1Bulan',
    ];
        public function marketing()
    {
        return $this->belongsTo(User::class, 'id_marketing');
    }
}
