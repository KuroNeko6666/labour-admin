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
        return view('home.participant',[
            'title' => 'Labour Admin',
            'active' => 'psychotest-participant',
            'path' => '/psychotest/participant',
            'data' => PsychotestParticipant::latest()->filter(request(['search']))->paginate(10)->withQueryString(),
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
        //
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
    public function destroy(PsychotestParticipant $psychotestParticipant)
    {
        //
    }
}
