<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePsychologistRequest;
use App\Http\Requests\UpdatePsychologistRequest;
use App\Models\Psychologist;

class PsychologistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Psychologist::latest()->filter(request(['search']))->paginate(10)->withQueryString();

        return view('home.psychologist',[
            'title' => 'Labour Admin',
            'active' => 'master-psychologist',
            'path' => '/master/psychologist',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.psychologist-add',[
            'title' => 'Labour Admin',
            'active' => 'master-psychologist',
            'path' => '/master/psychologist',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePsychologistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePsychologistRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email:dns|unique:psychologists',
            'password' => 'required|max:255|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        Psychologist::create($validated);
        return redirect()->route('psychologist')->with('message', 'Psikolog berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @return \Illuminate\Http\Response
     */
    public function show(Psychologist $psychologist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @return \Illuminate\Http\Response
     */
    public function edit(Psychologist $psychologist)
    {
        return view('home.psychologist-edit',[
            'title' => 'Labour Admin',
            'active' => 'master-psychologist',
            'path' => '/master/psychologist',
            'data' => $psychologist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePsychologistRequest  $request
     * @param  \App\Models\Psychologist  $psychologist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePsychologistRequest $request, Psychologist $psychologist)
    {
        $validated;
        if ($request->email == $psychologist->email){
            $validated = $request->validate([
                'name' => 'required|max:255',
            ]);
        } else {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255|email:dns|unique:psychologists',
            ]);
        }

        $psychologist->update($validated);
        return redirect()->route('psychologist')->with('message', 'Psikolog berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Psychologist $psychologist)
    {
        $psychotests = $psychologist->psychotest;
        foreach ($psychotests as $key => $psychotest) {
            $participants = $psychotest->participant;
            foreach ($participants as $key => $participant) {
                $participant->delete();
            }
            $psychotest->delete();
        }
        $psychologist->delete();
        return redirect()->route('psychologist')->with('message', 'Psikolog berhasil dihapus!');
    }
}
