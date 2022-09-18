<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function statusUser(Request $request){
        dd($equest);
        $user = User::find($request->id);
        if($user){
            return response()->json(['success'=>'Status change successfully.']);
        }
    }
}
