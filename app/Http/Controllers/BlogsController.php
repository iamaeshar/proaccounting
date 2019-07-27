<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use Validator;
use App\BlogComments;

class BlogsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'comment', 'search']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'DESC')->paginate(10);
        return view('blog.index')->with('blogs', $blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $validator = \Validator::make($request->all(), [
            'title' => 'required|max:255',
            'cover_img' => 'image',
            'keywords' => 'required',
            'description' => 'required',
            'url' => 'required',
            'blog_content' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all(),'status'=>false]);
        }

        if($request->hasFile('cover_img')){   
            $fileNameWithExt = $request->file('cover_img')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext = pathinfo($fileNameWithExt, PATHINFO_EXTENSION);
            $fileNameToStore = $fileName . '_' . time() . '.' . $ext;
            $path = $request->file('cover_img')->storeAs('public/cover_images', $fileNameToStore); 
        }

        $blog = new Blog;
        $blog->title = $request->input('title');
        $blog->blog_img = @$fileNameToStore;
        $blog->keywords = $request->input('keywords');
        $blog->description = $request->input('description');
        $blog->url = $request->input('url');
        $blog->blog_content = $request->input('blog_content');
        $blog->save();

        return response()->json(['message' =>'Blog Published Successfully', 'status'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $blog = Blog::where('url', $url)->first();
        $prev = Blog::select('url', 'title')->where('id', '<', $blog->id)->orderBy('id','desc')->first();
        $next = Blog::select('url', 'title')->where('id', '>', $blog->id)->first();
        $comments = BlogComments::where('blog_id', $blog->id)->get();
        $blogCount = BlogComments::where('blog_id', $blog->id)->count();
        return view('blog.show')->with('blog', $blog)->with('comments', $comments)->with('blogCount', $blogCount)->with('prev', $prev)->with('next', $next);
    }

    public function comment(Request $request) {
        $validatedQuery =  Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'required|url',
            'comment' => 'required'
        ]);

        if ($validatedQuery->fails()) {
            return redirect(url()->previous() . "#comment-form")->withErrors($validatedQuery->errors())->withInput();
        }

        $comment = new BlogComments;
        $comment->name = $request->input('name');
        $comment->email = $request->input('email');
        $comment->website = $request->input('website');
        $comment->comment = $request->input('comment');
        $comment->blog_id = $request->input('blog_id');
        $comment->save();

        return redirect(url()->previous() . "#id_blog-comments")->with('success', '');   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.pages.edit-blog')->with('blog', $blog);
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
        $validator = \Validator::make($request->all(), [
            'title' => 'required|max:255',
            'cover_img' => 'image',
            'keywords' => 'required',
            'description' => 'required',
            'url' => 'required',
            'blog_content' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all(),'status'=>false]);
        }

        if($request->hasFile('cover_img')){   
            $fileNameWithExt = $request->file('cover_img')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext = pathinfo($fileNameWithExt, PATHINFO_EXTENSION);
            $fileNameToStore = $fileName . '_' . time() . '.' . $ext;
            $path = $request->file('cover_img')->storeAs('public/cover_images', $fileNameToStore); 
        }

        $blog = Blog::find($id);
        $blog->title = $request->input('title');
        if($request->hasFile('cover_img')) {
            $blog->blog_img = $fileNameToStore;
        }
        $blog->keywords = $request->input('keywords');
        $blog->description = $request->input('description');
        $blog->url = $request->input('url');
        $blog->blog_content = $request->input('blog_content');
        $blog->save();

        return response()->json(['message' =>'Blog Published Successfully', 'status'=>true]);
    }

    public function search(Request $request) {
        $keywords = $request->input('title');
        $blogs = Blog::where('title', 'LIKE', '%' . $keywords. '%')->get();
        return view('blog.search')->with('blogs', $blogs)->with('keywords', $keywords);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $comments = BlogComments::where('blog_id', '=', $id);
        $comments->delete();

        $blog = Blog::find($id);
        $blog->delete();

        return redirect(url()->previous())->with('success', 'Blog deleted Successfully !!');
    }
}
