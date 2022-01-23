<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password as RulesPassword;
use App\Traits\UserTraits;

/* TODO is this necessary? */ 
class UserController extends Controller
{
    use UserTraits;

    /**
     * Change the password for the authenticated user
     */
    public function changePassword(Request $request) {
        $data = $request->validate([
            'current_password' => 'required|string',
            'new_password' => ['required', 'confirmed', RulesPassword::defaults()]
        ]);

        if(!(Hash::check($data['current_password'], Auth::user()->password))) {
            return response(['message'=>'Your current password does not match with the password you provided!']);
        }

        if(strcmp($data['current_password'], $data['new_password']) == 0) {
            return response(['message'=>'The new password must be different from the current password!']);
        }

        $user = Auth::user();
        $user->password = bcrypt($data['new_password']);
        // DEV Dá erro mas é culpa do intelephense
        $user->save();
        return response(['message'=>'Password changed!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|string'
        ]);

        if(!Hash::check($data['password'], Auth::user()->password)) {
            return response(['message'=>'Invalid Credentials. The account was not deleted!'], 401);
        }
        else {
            $id = $this->getUserID();
            User::find($id)->delete();
            return response(['message'=>'User Deleted!'], 200);
        }
       
    }
}
