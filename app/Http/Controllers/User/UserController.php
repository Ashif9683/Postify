<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function signUp()
    {
        return view('userPanel.userSignUp');
    }
    public function login()
    {
        return view('userPanel.userLogin');
    }
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'RePassword' => 'required|same:password',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Registration successful. Please log in.');
    }
    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('user.mypost')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentialsdss',
        ]);
    }

    public function addPost()
    {
        return view('userPanel.addPost');

    }
    public function storePost(Request $request)
    {

        $validated = $request->validate(
            [
                'postTitle' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'content' => 'required|string',
            ]
        );

        $imagePath = $request->file('image')->store('post_images', 'public');

        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $validated['postTitle'],
            'image' => $imagePath,
            'content' => $validated['content'],
        ]);

        return redirect()->route('user.mypost')->with('success', 'Post created successfully!');
    }


    public function myPosts()
    {

        $user = Auth::user();

        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('userPanel.userPost', compact('posts'));
    }
    public function editPost($id)
    {
        $post = Post::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('userPanel.addPost', compact('post'));
    }
    public function deletePost($id)
    {
        Post::where('id', $id)->where('user_id', auth()->id())->delete();
        return redirect()->route('user.mypost')->with('success', 'Post delete successfully!');

    }

    public function updatePost(Request $request, $id)
    {
        $request->validate(
            [
                'postTitle' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'content' => 'required|string',
            ]
        );

        $post = Post::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $post->title = $request->postTitle;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post_images', 'public');
            $post->image = $imagePath;
        } else {
            logger('No new image uploaded');
        }

        $post->save();

        return redirect()->route('user.mypost')->with('success', 'Post updated successfully!');
    }



}
