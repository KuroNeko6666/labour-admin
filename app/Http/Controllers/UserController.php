<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.user',[
            'title' => 'Labour Admin',
            'active' => 'master-user',
            'path' => '/master/user',
            'data' => User::latest()->filter(request(['search']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.user-add',[
            'title' => 'Labour Admin',
            'active' => 'master-user',
            'path' => '/master/user',
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
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email:dns|unique:users',
            'password' => 'required|max:255|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);
        return redirect()->route('user')->with('message', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('home.user-edit',[
            'title' => 'Labour Admin',
            'active' => 'master-user',
            'path' => '/master/user',
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated;
        if ($request->email == $user->email){
            $validated = $request->validate([
                'name' => 'required|max:255',
            ]);
        } else {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255|email:dns|unique:users',
            ]);
        }

        $user->update($validated);
        return redirect()->route('user')->with('message', 'Pengguna berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user')->with('message', 'Pengguna berhasil dihapus!');
    }
}
