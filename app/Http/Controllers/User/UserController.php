<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


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


        if (!$request->hasFile('image')) {
            Log::warning('Image not found in request');
        } else {
            Log::info('Image file info:', [
                'originalName' => $request->file('image')->getClientOriginalName(),
                'mimeType' => $request->file('image')->getMimeType(),
                'size' => $request->file('image')->getSize()
            ]);
        }

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
        Log::info("UpdatePost called for post ID: {$id}");

        $request->validate(
            [
                'postTitle' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'content' => 'required|string',
            ]
        );

        $post = Post::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        Log::info("Post found for update", ['title' => $post->title]);

        $post->title = $request->postTitle;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            Log::info('New image uploaded:', [
                'originalName' => $request->file('image')->getClientOriginalName()
            ]);

            $imagePath = $request->file('image')->store('post_images', 'public');
            Log::info('New image stored at: ' . $imagePath);

            $post->image = $imagePath;
        } else {
            Log::info('No new image uploaded');
        }

        $post->save();

        return redirect()->route('user.mypost')->with('success', 'Post updated successfully!');
    }



}
