<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'title' => 'Daftar Mahasiswa',
            'roles' => Role::all(),
            'users' => User::where('role_id', 2)->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'nomor_induk' => 'required|min:8|unique:users,nomor_induk',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4', 
            'role_id' => 'required'
        ]);
    
        $validatedData['password'] = bcrypt($validatedData['password']);
    
        try {
            User::create($validatedData);
            return redirect('/dashboard/users')->with('userSuccess', 'Data mahasiswa berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/dashboard/users')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
        return json_encode($user);
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
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email',
            'role_id' => 'required',
        ];
    
        // If the provided nomor_induk is different from the original one, add validation rule
        if ($request->nomor_induk != $user->nomor_induk) {
            $rules['nomor_induk'] = 'required|min:8|unique:users,nomor_induk';
        }
    
        $validatedData = $request->validate($rules);
    
        // Update the user data
        $user->update($validatedData);
    
        return redirect('/dashboard/users')->with('userSuccess', 'Data mahasiswa berhasil diubah');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('deleteUser', 'Hapus data mahasiswa berhasil');
    }

    public function makeAdmin($id)
    {
        $userData = [
            'role_id' => 1,
        ];

        User::where('id', $id)->update($userData);

        return redirect('/dashboard/admin')->with('adminSuccess', 'Data admin berhasil ditambahkan');
    }
}
