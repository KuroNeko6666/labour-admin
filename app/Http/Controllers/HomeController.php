<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
class HomeController extends Controller
{
    public function index(){
        return view('home.index', [
            'active' => 'dashboard',
            'title' => 'Labour | Admin',
            'user' => User::all(),
            'company' => Company::all(),
            'silver' => Company::latest()->filter(['member' => 'silver']),
            'gold' => Company::latest()->filter(['member' => 'gold']),
        ]);
    }
}
