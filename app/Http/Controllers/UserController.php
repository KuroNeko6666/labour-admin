<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::latest()->filter(request(['search']))->paginate(10)->withQueryString();

        return view('home.user',[
            'title' => 'Labour Admin',
            'active' => 'master-user',
            'path' => '/master/user',
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
            'hp' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'provinsi' => 'required|max:255',
            'kokab' => 'required|max:255',
            'alamat' => 'required|max:255',
            'kewarganegaraan' => 'required|max:255',
            'agama' => 'required|max:255',
            'foto' => 'required|max:2048',

        ]);
        $file = $request->file('foto');
        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        if(!$user){
            return redirect()->back()->with('error', 'Gagal menambahkan pengguna');
        }

        $nameFile = 'FU-'.sprintf("%06s", $user->id);
        $nameFile .= '.'.$file->extension();

        $file->storeAs('foto', $nameFile);
        $validated['foto'] = $nameFile;
        $user->update([
            'foto' => $validated['foto'],
        ]);

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
        if($request->file('foto')){
            if ($request->email == $user->email){
                $validated = $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|max:255|email:dns',
                    'hp' => 'required|max:255',
                    'tempat_lahir' => 'required|max:255',
                    'tanggal_lahir' => 'required|max:255',
                    'provinsi' => 'required|max:255',
                    'kokab' => 'required|max:255',
                    'alamat' => 'required|max:255',
                    'kewarganegaraan' => 'required|max:255',
                    'agama' => 'required|max:255',
                    'foto' => 'required|max:2048',
                ]);
            } else {
                $validated = $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|max:255|email:dns',
                    'hp' => 'required|max:255',
                    'tempat_lahir' => 'required|max:255',
                    'tanggal_lahir' => 'required|max:255',
                    'provinsi' => 'required|max:255',
                    'kokab' => 'required|max:255',
                    'alamat' => 'required|max:255',
                    'kewarganegaraan' => 'required|max:255',
                    'agama' => 'required|max:255',
                    'foto' => 'required|max:2048',
                ]);
            }
            $file = $request->file('foto');
            $nameFile = 'FU-'.sprintf("%06s", $user->id);
            $nameFile .= '.'.$file->extension();
            $file->storeAs('foto', $nameFile);
            $validated['foto'] = $nameFile;
        } else {
            if ($request->email == $user->email){
                $validated = $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|max:255|email:dns|unique:users',
                    'hp' => 'required|max:255',
                    'tempat_lahir' => 'required|max:255',
                    'tanggal_lahir' => 'required|max:255',
                    'provinsi' => 'required|max:255',
                    'kokab' => 'required|max:255',
                    'alamat' => 'required|max:255',
                    'kewarganegaraan' => 'required|max:255',
                    'agama' => 'required|max:255',
                ]);
            } else {
                $validated = $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|max:255|email:dns|unique:users',
                    'hp' => 'required|max:255',
                    'tempat_lahir' => 'required|max:255',
                    'tanggal_lahir' => 'required|max:255',
                    'provinsi' => 'required|max:255',
                    'kokab' => 'required|max:255',
                    'alamat' => 'required|max:255',
                    'kewarganegaraan' => 'required|max:255',
                    'agama' => 'required|max:255',
                ]);
            }
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
        File::delete($user->foto);
        $user->delete();
        return redirect()->route('user')->with('message', 'Pengguna berhasil dihapus!');
    }
}
