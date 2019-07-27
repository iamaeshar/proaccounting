<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class IndexController extends Controller
{
    public function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = strtolower($string); // Convert to lowercase
 
        return $string;
    }

    public function index() {
        $blogs = Blog::orderBy('id', 'DESC')->take(3)->get();
        // foreach($blogs as $blog) {
        //     $blog['url'] = $this->clean($blog->title);
        // }
        return view('index')->with('blogs', $blogs);
    }

}
