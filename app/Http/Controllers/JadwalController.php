<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;
use App\Models\Jadwal;
use App\Models\JadwalsUser;
use App\Models\Psychologist;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jadwal::latest()->filter(request(['search']))->paginate(10)->withQueryString();

        return view('home.schedule',[
            'title' => 'Labour Admin',
            'active' => 'psychotest-schedule',
            'path' => '/psychotest/schedule',
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
        return view('home.schedule-add',[
            'title' => 'Labour Admin',
            'active' => 'psychotest-schedule',
            'path' => '/psychotest/schedule',
            'psychologist' => Psychologist::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJadwalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJadwalRequest $request)
    {
        if(Psychologist::find($request->psikolog_id)){
            $validated = $request->validate([
                'psikolog_id' => 'required|max:255',
                'jenis_test' => 'required|max:255',
                'waktu' => 'required|max:255',
                'kuota' => 'required|max:255',
            ]);
            Jadwal::create($validated);
            return redirect()->route('schedule')->with('message', 'Jadwal berhasil ditambahkan!');
        }
        return redirect()->back()->with('error', 'Psikolog tidak ditemukan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $schedule)
    {
        return view('home.schedule-edit',[
            'title' => 'Labour Admin',
            'active' => 'psychotest-schedule',
            'path' => '/psychotest/schedule',
            'data' => $schedule
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJadwalRequest  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJadwalRequest $request, Jadwal $schedule)
    {
        if(Psychologist::find($request->psikolog_id)){
            $validated = $request->validate([
                'psikolog_id' => 'required|max:255',
                'jenis_test' => 'required|max:255',
                'waktu' => 'required|max:255',
                'kuota' => 'required|max:255',
            ]);

            $schedule->update($validated);
            return redirect()->route('schedule')->with('message', 'Jadwal berhasil diubah!');
        }

        return redirect()->back()->with('error', 'Psikolog tidak ditemukan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $schedule)
    {
        $participants = JadwalsUser::where('jadwal_id', $schedule->id)->get();
        foreach ($participants as $participant) {
            $participant->delete();
        }
        $schedule->delete();
        return redirect()->route('schedule')->with('message', 'Jadwal berhasil dihapus!');
    }
}
