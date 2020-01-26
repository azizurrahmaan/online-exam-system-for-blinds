<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect()->route('register');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {   
        $user = \App\User::findorFail($id);
        return view('users.edit', ['user'=> $user]);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id)
    { 
        
        $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id.',id'],
            'password' => ['string', 'min:8', 'confirmed'],
            'role' => ['required', 'string'],
        ]);
        
        
        $user = \App\User::findorFail($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->role = request('role');

        if(request('password')){
            $user->password = Hash::make(request('password'));
        }

        $user->save();

        return back();
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findorFail($id);
        $user->forceDelete();
        return back();
    }


}
