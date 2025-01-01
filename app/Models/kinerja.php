<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kinerja extends Model

{
    protected $fillable = ['user_id', 'perilaku', 'nilai', 'month', 'year'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
