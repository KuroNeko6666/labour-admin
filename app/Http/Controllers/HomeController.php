<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Perusahaan;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index(){
        $day = User::whereDate( 'created_at', Carbon::today())->get()->count();
        $day1 = User::whereDate( 'created_at', Carbon::today()->subDay(1))->get()->count();
        $day2 = User::whereDate( 'created_at', Carbon::today()->subDay(2))->get()->count();
        $day3 = User::whereDate( 'created_at', Carbon::today()->subDay(3))->get()->count();
        $day4 = User::whereDate( 'created_at', Carbon::today()->subDay(4))->get()->count();
        $day5 = User::whereDate( 'created_at', Carbon::today()->subDay(5))->get()->count();
        $day6 = User::whereDate( 'created_at', Carbon::today()->subDay(6))->get()->count();
        $data_register = array(
            Carbon::today()->toDateString() => $day,
            Carbon::today()->subDay(1)->toDateString() => $day1,
            Carbon::today()->subDay(2)->toDateString() => $day2,
            Carbon::today()->subDay(3)->toDateString() => $day3,
            Carbon::today()->subDay(4)->toDateString() => $day4,
            Carbon::today()->subDay(5)->toDateString() => $day5,
            Carbon::today()->subDay(6)->toDateString() => $day6,
        );
        // dd(array_keys($data_register));
        return view('home.index', [
            'active' => 'dashboard',
            'title' => 'Labour | Admin',
            'user' => User::all(),
            'company' => Perusahaan::all(),
            'silver' => Perusahaan::latest()->filter(['member' => 'silver']),
            'gold' => Perusahaan::latest()->filter(['member' => 'gold']),
            'data_register' => $data_register,
        ]);
    }
}
