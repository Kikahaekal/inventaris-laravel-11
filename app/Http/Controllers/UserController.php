<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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
            return redirect('/')->with('success_register', 'Register Successfully');
        } else {
            return back()->with('failed_register', 'Check Your Input');
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
            return redirect('/dashboard')->with('success_login', 'Login Successfully');
        } else {
            return back()->with('failed_login', 'Check your data again');
        }
    }

    public function dashboard()
    {
        $total_items = count(Item::where('user_id', Auth::user()->id)->get());
        $total_category = count(Category::where('user_id', Auth::user()->id)->get());
        $total_transaction = count(Transaction::where('user_id', Auth::user()->id)->get());
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        $profit = 0;
        $selled_item = 0;

        foreach($transactions as $transaction) {
            $profit += $transaction->transaction_amount;
            $selled_item += $transaction->buy_amount;
        }

        return view('dashboard.index', [
            'title' => 'Dashboard'
        ], compact('total_category', 'total_items', 'total_transaction', 'profit', 'selled_item'));
    }

    public function user_profile($id)
    {
        $user = User::where('id', $id)->first();

        return view('dashboard.user.index', [
            'title' => 'Profile'
        ], compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns'
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return back()->with('success_edit', 'Data Updated');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('success_logout', 'Logout Successfully');
    }
}
