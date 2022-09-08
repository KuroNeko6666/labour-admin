<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use File;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Vacancy::latest()->filter(request(['search']))->paginate(10)->withQueryString();

        return view('home.vacancy',[
            'title' => 'Labour Admin',
            'active' => 'vacancy',
            'path' => '/vacancy',
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
        return view('home.vacancy-add',[
            'title' => 'Labour Admin',
            'active' => 'vacancy',
            'path' => '/vacancy',
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
        $file = $request->file('gambar');
        $validated = $request->validate([
            'lowongan' => 'required|max:255',
            'skill' => 'required|max:255',
            'min_gaji' => 'required|max:255',
            'max_gaji' => 'required|max:255',
            'experience' => 'required|max:255',
            'lokasi' => 'required|max:255',
            'jobdesk' => 'required',
            'gambar' => 'required|max:3056',
        ]);
        $vacancy = Vacancy::create($validated);
        $file->storeAs('gambar_lowongan', $vacancy['id'].'.'.$file->extension());
        $validated['gambar'] = storage_path('app/gambar_lowongan/'.$vacancy['id'].'.'.$file->extension());
        $vacancy->update([
            'gambar' => $validated['gambar'],
        ]);
        return redirect()->route('vacancy')->with('message', 'Lowongan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function show(Vacancy $vacancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacancy $vacancy)
    {
        return view('home.vacancy-edit',[
            'title' => 'Labour Admin',
            'active' => 'vacancy',
            'path' => '/vacancy',
            'data' => $vacancy
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        $validated;
        if($request->file('gambar')){
            $validated = $request->validate([
                'lowongan' => 'required|max:255',
                'skill' => 'required|max:255',
                'min_gaji' => 'required|max:255',
                'max_gaji' => 'required|max:255',
                'experience' => 'required|max:255',
                'lokasi' => 'required|max:255',
                'jobdesk' => 'required',
                'gambar' => 'required|max:3056',
            ]);
            $file = $request->file('gambar');
            $file->storeAs('gambar_lowongan', $vacancy['id'].'.'.$file->extension());
            $validated['gambar'] = storage_path('app/gambar_lowongan/'.$vacancy['id'].'.'.$file->extension());
        } else {
            $validated = $request->validate([
                'lowongan' => 'required|max:255',
                'skill' => 'required|max:255',
                'min_gaji' => 'required|max:255',
                'max_gaji' => 'required|max:255',
                'experience' => 'required|max:255',
                'lokasi' => 'required|max:255',
                'jobdesk' => 'required',
            ]);
        }

        $vacancy->update($validated);
        return redirect()->route('vacancy')->with('message', 'Lowongan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        File::delete($vacancy->gambar);
        $vacancy->delete();
        return redirect()->route('vacancy')->with('message', 'Lowongan berhasil dihapus!');
    }
}
