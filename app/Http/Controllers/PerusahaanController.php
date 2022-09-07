<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePerusahaanRequest;
use App\Http\Requests\UpdatePerusahaanRequest;
use App\Models\Perusahaan;
use File;


class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Perusahaan::latest()->filter(request(['search']))->paginate(10)->withQueryString();
        return view('home.company',[
            'title' => 'Labour Admin',
            'active' => 'master-company',
            'path' => '/master/company',
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
        return view('home.company-add',[
            'title' => 'Labour Admin',
            'active' => 'master-company',
            'path' => '/master/company',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePerusahaanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePerusahaanRequest $request)
    {
        $file = $request->file('logo');
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email:dns|unique:perusahaans',
            'password' => 'required|max:255|min:6',
            'alamat' => 'required|max:255',
            'hp' => 'required|max:255',
            'web' => 'required|max:255',
            'logo' => 'required|max:3056',
            'visi' => 'required',
            'misi' => 'required',
            'deskripsi' => 'required',
            'member' => 'required',
        ]);
        $validated['password'] = bcrypt($validated['password']);
        $company = Perusahaan::create($validated);
        $file->storeAs('logo_perusahaan', $company['id'].'.'.$file->extension());
        $validated['logo'] = storage_path('app/logo_perusahaan/'.$company['id'].'.'.$file->extension());
        $company->update([
            'logo' => $validated['logo'],
        ]);
        return redirect()->route('company')->with('message', 'Perusahaan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perusahaan $company)
    {
        return view('home.company-edit',[
            'title' => 'Labour Admin',
            'active' => 'master-company',
            'path' => '/master/company',
            'data' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePerusahaanRequest  $request
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePerusahaanRequest $request, Perusahaan $company)
    {
        $validated;
        if($request->file('logo')){
            if ($request->email == $company->email){
                $validated = $request->validate([
                    'name' => 'required|max:255',
                    'alamat' => 'required|max:255',
                    'hp' => 'required|max:255',
                    'web' => 'required|max:255',
                    'logo' => 'required|max:3056',
                    'visi' => 'required',
                    'misi' => 'required',
                    'deskripsi' => 'required',
                    'member' => 'required',
                ]);
            } else {
                $validated = $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|max:255|email:dns|unique:perusahaans',
                    'alamat' => 'required|max:255',
                    'hp' => 'required|max:255',
                    'web' => 'required|max:255',
                    'logo' => 'required|max:3056',
                    'visi' => 'required',
                    'misi' => 'required',
                    'deskripsi' => 'required',
                    'member' => 'required',
                ]);
            }
            $file = $request->file('logo');
            $file->storeAs('logo_perusahaan', $company['id'].'.'.$file->extension());
            $validated['logo'] = storage_path('app/logo_perusahaan/'.$company['id'].'.'.$file->extension());
        } else {
            if ($request->email == $company->email){
                $validated = $request->validate([
                    'name' => 'required|max:255',
                    'alamat' => 'required|max:255',
                    'hp' => 'required|max:255',
                    'web' => 'required|max:255',
                    'visi' => 'required',
                    'misi' => 'required',
                    'deskripsi' => 'required',
                    'member' => 'required',
                ]);
            } else {
                $validated = $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|max:255|email:dns|unique:perusahaans',
                    'alamat' => 'required|max:255',
                    'hp' => 'required|max:255',
                    'web' => 'required|max:255',
                    'visi' => 'required',
                    'misi' => 'required',
                    'deskripsi' => 'required',
                    'member' => 'required',
                ]);
            }
        }
        $company->update($validated);
        return redirect()->route('company')->with('message', 'Perusahaan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $company)
    {
        File::delete($company->logo);
        $company->delete();
        return redirect()->route('company')->with('message', 'perusahaan berhasil dihapus!');
    }

}
