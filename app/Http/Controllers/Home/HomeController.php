<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::with('user')->latest()->get();

        return view('homePage.home', compact('posts'));
    }

    public function post($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return view('homePage.post', compact('post')); // Use correct view path and variable
    }
}
