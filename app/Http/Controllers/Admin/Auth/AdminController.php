<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('adminPanel.adminSignIn');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin_logged_in' => true, 'admin_id' => $admin->id]);
            return redirect()->route('admin.posts')->with('success', 'Welcome back, Admin!');

        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function posts()
    {
        $posts = Post::with('user')->get();

        return view('adminPanel.posts', compact('posts'));
    }

    public function users()
    {
        $users = User::withCount('posts')->get();
        
        return view('adminPanel.users', compact('users'));
    }

    public function deleteUser($id)
    {
        if ($id) {
            User::where('id', $id)->delete();
        }
        return redirect()->back()->with('success', 'User delete successfully!');
    }
    public function logout()
    {
        session()->flush();
        return redirect()->route('admin.login');
    }
}
