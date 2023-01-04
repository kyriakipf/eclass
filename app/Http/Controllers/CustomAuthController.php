<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }

    public function changePasswordView()
    {
//        dd();
        switch (strtolower(auth()->user()->role->role_name))
        {
            case('teacher'):
                return view('teacher.change-password');
            case('administrator'):
                return view('auth.change-password');
            case('student'):
                return view('student.change-password');
        }

    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);
        $user = Auth::user();
        $pass = $user->password;

        if (Hash::check($request->oldPassword, $pass))
        {

            if (Hash::check($request->newPassword, $pass))
            {
                return back()->with('error', "New password can't be the same as the old password!");
            }

            if ($request->newPassword === $request->confirmPassword)
            {
                $user->password = Hash::make($request->newPassword);
                $user->save();
                return back()->with('success', 'Password changed');
            }else
            {
                return back()->with('error', 'New passwords do not match!');
            }

        }else
        {
            return back()->with('error', 'Current password does not match!');
        }


    }
}
