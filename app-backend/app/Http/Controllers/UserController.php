<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/* TODO is this necessary? */ 
class UserController extends Controller
{
    /**
     * Change the password for the authenticated user
     */
    public function changePassword(Request $request) {
        $data = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed'
        ]);

        if(!(Hash::check($data['current_password'], Auth::user()->password))) {
            return response(['message'=>'Your current password does not match with the password you provided!']);
        }

        if(strcmp($data['current_password'], $data['new_password']) == 0) {
            return response(['message'=>'The new password must be different from the current password!']);
        }

        $user = Auth::user();
        $user->password = bcrypt($data['new_password']);
        $user->save();
        return response(['message'=>'Password changed!']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
