<?php

namespace App\Http\Controllers;

use App\Models\Psychotest;
use App\Models\Psychologist;
use App\Models\PsychotestParticipant;
use Illuminate\Http\Request;

class PsychotestScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = 'unfinished';
        if(request('status')){
            $status = request('status');
        }

        return view('home.schedule',[
            'title' => 'Labour Admin',
            'active' => 'psychotest-schedule',
            'path' => '/psychotest/schedule',
            'status' => $status,
            'data' => Psychotest::latest()->filter(['status' => $status])->filter(request(['search']))->paginate(10)->withQueryString(),
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Psychologist::find($request->psychologist_id)){
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
        return redirect()->back()->with('error', 'Psikolog tidak ditemukan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Http\Response
     */
    public function show(Psychotest $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Http\Response
     */
    public function edit(Psychotest $schedule)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Psychotest $schedule)
    {
        if(Psychologist::find($request->psychologist_id)){
            $validated = $request->validate([
                'psychologist_id' => 'required|max:255',
                'location' => 'required|max:255',
                'date' => 'required|max:255',
                'time' => 'required|max:255',
                'quota' => 'required|max:255',
                'status' => 'required|max:255|in:unfinished,finished,cancel',
            ]);

            $schedule->update($validated);
            return redirect()->route('schedule')->with('message', 'Jadwal berhasil diubah!');
        }

        return redirect()->back()->with('error', 'Psikolog tidak ditemukan!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Psychotest $schedule)
    {
        $participants = PsychotestParticipant::where('psychotest_id', $schedule->id)->get();
        foreach ($participants as $participant) {
            $participant->delete();
        }
        $schedule->delete();
        return redirect()->route('schedule')->with('message', 'Jadwal berhasil dihapus!');
    }
}
