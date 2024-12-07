<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kinerja extends Model
{
    protected $fillable = ['nama', 'perilaku', 'nilai', 'month', 'year'];

    // If you have relationships with other models like User or Perilaku, define them
    public function user()
    {
        return $this->belongsTo(User::class, 'nama');
    }
}
