<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePsychogramRequest;
use App\Http\Requests\UpdatePsychogramRequest;
use App\Models\Psychogram;
use File;

class PsychogramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.psychogram',[
            'title' => 'Labour Admin',
            'active' => 'psychogram',
            'path' => '/psychogram',
            'data' => Psychogram::latest()->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.psychogram-add',[
            'title' => 'Labour Admin',
            'active' => 'psychogram',
            'path' => '/psychogram',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePsychogramRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePsychogramRequest $request)
    {
        $file = $request->file('file');
        try {
            Psychogram::create([
                'file' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'url' =>  storage_path('app/tools_psikogram/'.$file->getClientOriginalName()),
            ]);
        } catch (\Illuminate\Database\QueryException $exception) {
            return redirect()->back()->with('error', 'file sudah tersedia');
        }

        $request->file->storeAs('tools_psikogram', $file->getClientOriginalName());
        return redirect()->route('psychogram')->with('message', 'alat psikogram berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Psychogram  $psychogram
     * @return \Illuminate\Http\Response
     */
    public function show(Psychogram $psychogram)
    {
        return response()->download($psychogram->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Psychogram  $psychogram
     * @return \Illuminate\Http\Response
     */
    public function edit(Psychogram $psychogram)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePsychogramRequest  $request
     * @param  \App\Models\Psychogram  $psychogram
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePsychogramRequest $request, Psychogram $psychogram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Psychogram  $psychogram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Psychogram $psychogram)
    {
        File::delete($psychogram->url);
        $psychogram->delete();

        return redirect()->route('psychogram')->with('message', 'alat psikogram berhasil di dihapus');
    }
}
