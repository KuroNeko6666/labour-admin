<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.company',[
            'title' => 'Labour Admin',
            'active' => 'master-company',
            'path' => '/master/company',
            'data' => Company::latest()->filter(request(['search']))->paginate(10)->withQueryString()
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
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email:dns|unique:companies',
            'password' => 'required|max:255|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        Company::create($validated);
        return redirect()->route('company')->with('message', 'Perusahaan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
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
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $validated;
        if ($request->email == $company->email){
            $validated = $request->validate([
                'name' => 'required|max:255',
            ]);
        } else {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255|email:dns|unique:companies',
            ]);
        }

        $company->update($validated);
        return redirect()->route('company')->with('message', 'Perusahaan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('company')->with('message', 'Perusahaan berhasil dihapus!');
    }
}
