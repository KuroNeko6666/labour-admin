<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePsychotestRequest;
use App\Http\Requests\UpdatePsychotestRequest;
use App\Models\Psychotest;

class PsychotestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.schedule',[
            'title' => 'Labour Admin',
            'active' => 'psychotest-schedule',
            'path' => '/psychotest/schedule',
            'data' => Psychotest::latest()->filter(request(['search']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.schedule-add',[
            'title' => 'Labour Admin',
            'active' => 'psychotest-schedule',
            'path' => '/psychotest/schedule',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePsychotestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePsychotestRequest $request)
    {
        $validated = $request->validate([
            'psychologist_id' => 'required|max:255',
            'location' => 'required|max:255',
            'date' => 'required|max:255',
            'time' => 'required|max:255',
            'quota' => 'required|max:255',
        ]);

        Psychotest::create($validated);
        return redirect()->route('schedule')->with('message', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Http\Response
     */
    public function show(Psychotest $psychotest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Http\Response
     */
    public function edit(Psychotest $psychotest)
    {
        dd($psychotest);
        return view('home.schedule-edit',[
            'title' => 'Labour Admin',
            'active' => 'psychotest-schedule',
            'path' => '/psychotest/schedule',
            'data' => $psychotest
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePsychotestRequest  $request
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePsychotestRequest $request, Psychotest $psychotest)
    {
        $validated = $request->validate([
            'psycholog_id' => 'required|max:255',
            'location' => 'required|max:255',
            'date' => 'required|max:255',
            'time' => 'required|max:255',
            'quota' => 'required|max:255',
        ]);

        $psychotest->update($validated);
        return redirect()->route('schedule')->with('message', 'Jadwal berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Psychotest $psychotest)
    {
        $psychotest->delete();
        return redirect()->route('schedule')->with('message', 'Jadwal berhasil dihapus!');
    }
}
