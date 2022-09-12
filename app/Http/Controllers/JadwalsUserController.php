<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJadwalsUserRequest;
use App\Http\Requests\UpdateJadwalsUserRequest;
use App\Models\JadwalsUser;
use App\Models\Jadwal;
use App\Models\User;

class JadwalsUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JadwalsUser::latest()->filter(request(['search','psychotest']))->paginate(10)->withQueryString();

        return view('home.participant',[
            'title' => 'Labour Admin',
            'active' => 'psychotest-participant',
            'path' => '/psychotest/participant',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.participant-add',[
            'title' => 'Labour Admin',
            'active' => 'psychotest-participant',
            'path' => '/psychotest/participant',
            'user' => User::all(),
            'psychotest' => Jadwal::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJadwalsUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJadwalsUserRequest $request)
    {
        $validated;
        $user = User::find($request->users_id);
        $participants = JadwalsUser::where('jadwal_id', $request->jadwal_id)->count();
        $psychotest = Jadwal::find($request->jadwal_id);
        $exist = JadwalsUser::where('jadwal_id', $request->jadwal_id)->where('users_id', $request->users_id)->first();
        if( $user && $psychotest ){
            if( true ){
                if(!$exist){
                    $quota = $psychotest->kuota;
                    if($quota > $participants){
                        $validated = $request->validate([
                            'users_id' => 'required',
                            'jadwal_id' => 'required',
                        ]);
                        $jadwaluser = '';
                        if($jadwaluser = JadwalsUser::create($validated)){
                            $req = '';
                            $kode_test = 'NT-'. date('m'). substr(str_repeat(0,5). $jadwaluser->id, - 5);
                            if(request('psychotest')){
                                $req = '?psychotest='.request('psychotest');
                            }
                            return redirect(route('participant').$req ?? '')->with('message', 'Peserta berhasil didaftarkan');
                        }
                        return redirect()->back()->with('error', 'Gagal registrasi');
                    }
                    return redirect()->back()->with('error', 'Kuota sudah penuh');
                }
                return redirect()->back()->with('error', 'User sudah mendaftar, gunakan user atau psikotest lain');
            }
        }
        return redirect()->back()->with('error', 'User atau psikotest tidak ditemukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JadwalsUser  $jadwalsUser
     * @return \Illuminate\Http\Response
     */
    public function show(JadwalsUser $jadwalsUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JadwalsUser  $jadwalsUser
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalsUser $jadwalsUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJadwalsUserRequest  $request
     * @param  \App\Models\JadwalsUser  $jadwalsUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJadwalsUserRequest $request, JadwalsUser $jadwalsUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JadwalsUser  $jadwalsUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(JadwalsUser $participant)
    {
        $participant->delete();
        $req = '';
        if(request('psychotest')){
            $req = '?psychotest='.request('psychotest');
        }
        return redirect(route('participant').$req)->with('message', 'Peserta berhasil dihapus');
    }
}
