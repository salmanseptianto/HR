<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Harian;
use App\Models\Mingguan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MhController extends Controller
{
    public function index()
    {
        return view('mh.dashboard');
    }
    public function print(){
        return view('');
    }
}
