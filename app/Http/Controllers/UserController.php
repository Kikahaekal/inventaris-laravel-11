<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('authentication.login', [
            'title' => 'Login'
        ]);
    }

    public function register()
    {
        return view('authentication.register', [
            'title' => 'Register'
        ]);
    }

    public function create_user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email:dns'
        ]);

        $data = $request->only('name', 'email');
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        if($user) {
            return redirect('/');
        } else {
            return back();
        }
    }

    public function login_user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $user_credential = $request->only('name', 'password');

        if(Auth::attempt($user_credential)) {
            return redirect('/dashboard');
        } else {
            return back();
        }
    }

    public function dashboard()
    {
        $total_items = count(Item::where('user_id', Auth::user()->id)->get());
        $total_category = count(Category::where('user_id', Auth::user()->id)->get());

        return view('dashboard.index', [
            'title' => 'Dashboard'
        ], compact('total_category', 'total_items'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
