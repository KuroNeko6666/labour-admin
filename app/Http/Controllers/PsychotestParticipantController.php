<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePsychotestParticipantRequest;
use App\Http\Requests\UpdatePsychotestParticipantRequest;
use App\Models\PsychotestParticipant;
use App\Models\Psychotest;
use App\Models\User;

class PsychotestParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PsychotestParticipant::latest()->filter(request(['search','psychotest']))->paginate(10)->withQueryString();

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
            'psychotest' => Psychotest::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePsychotestParticipantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePsychotestParticipantRequest $request)
    {
        $validated;
        $user = User::find($request->user_id);
        $participants = PsychotestParticipant::where('psychotest_id', $request->psychotest_id)->count();
        $psychotest = Psychotest::find($request->psychotest_id);
        $exist = PsychotestParticipant::where('psychotest_id', $request->psychotest_id)->where('user_id', $request->user_id)->first();
        if( $user && $psychotest ){
            $cancel = $psychotest->status === 'cancel';
            $finish = $psychotest->status === 'finished';
            if( !$cancel || !$finish){
                if(!$exist){
                    $quota = $psychotest->quota;
                    if($quota > $participants){
                        $validated = $request->validate([
                            'user_id' => 'required',
                            'psychotest_id' => 'required',
                        ]);
                        if(PsychotestParticipant::create($validated)){
                            $req;
                            if(request('psychotest')){
                                $req = '?psychotest='.request('psychotest');
                            }
                            return redirect(route('participant').$req)->with('message', 'Peserta berhasil didaftarkan');
                        }
                        return redirect()->back()->with('error', 'Gagal registrasi');
                    }
                    return redirect()->back()->with('error', 'Kuota sudah penuh');
                }
                return redirect()->back()->with('error', 'User sudah mendaftar, gunakan user atau psikotest lain');
            }
            return redirect()->back()->with('error', 'Pendaftaran psikotest dengan id tersebut telah ditutup');
        }
        return redirect()->back()->with('error', 'User atau psikotest tidak ditemukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PsychotestParticipant  $psychotestParticipant
     * @return \Illuminate\Http\Response
     */
    public function show(PsychotestParticipant $psychotestParticipant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PsychotestParticipant  $psychotestParticipant
     * @return \Illuminate\Http\Response
     */
    public function edit(PsychotestParticipant $psychotestParticipant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePsychotestParticipantRequest  $request
     * @param  \App\Models\PsychotestParticipant  $psychotestParticipant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePsychotestParticipantRequest $request, PsychotestParticipant $psychotestParticipant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PsychotestParticipant  $psychotestParticipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(PsychotestParticipant $participant)
    {
        $participant->delete();
        $req;
        if(request('psychotest')){
            $req = '?psychotest='.request('psychotest');
        }
        return redirect(route('participant').$req)->with('message', 'Peserta berhasil dihapus');

    }
}
