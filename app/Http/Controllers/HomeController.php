<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Perusahaan;
class HomeController extends Controller
{
    public function index(){
        return view('home.index', [
            'active' => 'dashboard',
            'title' => 'Labour | Admin',
            'user' => User::all(),
            'company' => Perusahaan::all(),
            'silver' => Perusahaan::latest()->filter(['member' => 'silver']),
            'gold' => Perusahaan::latest()->filter(['member' => 'gold']),
        ]);
    }
}
