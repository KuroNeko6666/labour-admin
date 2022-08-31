<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.admin',[
            'title' => 'Labour Admin',
            'active' => 'master-admin',
            'path' => '/master/admin',
            'data' => Admin::latest()->filter(request(['search']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.admin-add',[
            'title' => 'Labour Admin',
            'active' => 'master-admin',
            'path' => '/master/admin',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email:dns|unique:admins',
            'password' => 'required|max:255|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        Admin::create($validated);
        return redirect()->route('admin')->with('message', 'Admin berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('home.admin-edit',[
            'title' => 'Labour Admin',
            'active' => 'master-admin',
            'path' => '/master/admin',
            'data' => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $validated;
        if ($request->email == $admin->email){
            $validated = $request->validate([
                'name' => 'required|max:255',
            ]);
        } else {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255|email:dns|unique:admins',
            ]);
        }

        $admin->update($validated);
        return redirect()->route('admin')->with('message', 'Admin berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin')->with('message', 'Admin berhasil dihapus!');

    }
}
