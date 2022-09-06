<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;
use App\Models\Category;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.skill',[
            'title' => 'Labour Admin',
            'active' => 'skill-data',
            'path' => '/skill/data',
            'data' => Skill::latest()->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.skill-add',[
            'title' => 'Labour Admin',
            'active' => 'skill-data',
            'path' => '/skill/data',
            'category' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSkillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkillRequest $request)
    {


            $validated = $request->validate([
                'skill_group' => 'required|max:255',
                'skill' => 'required|max:255|unique:skills',
            ]);
            Skill::create($validated);
            return redirect()->route('skill')->with('message', 'Skill berhasil ditambahkan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $data)
    {
        return view('home.skill-edit',[
            'title' => 'Labour Admin',
            'active' => 'skill-data',
            'path' => '/skill/data',
            'data' => $data,
            'category' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSkillRequest  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkillRequest $request, Skill $data)
    {
            $validated;
            if ($request->skill != $data->skill){
                $validated = $request->validate([
                    'skill_group' => 'required|max:255',
                    'skill' => 'required|max:255|unique:skills',
                ]);
            } else {
                $validated = $request->validate([
                    'skill_group' => 'required|max:255',
                ]);
            }

            $data->update($validated);
            return redirect()->route('skill')->with('message', 'Skill berhasil diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $data)
    {
        $data->delete();
        return redirect()->route('skill')->with('message', 'Skill berhasil dihapus!');

    }
}
