<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Blog;
use App\BlogComments;
use App\Query;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogCount = Blog::count();
        $commentCount = BlogComments::count();
        $queryCount = Query::count();
        return view('admin.dashboard')->with(compact('blogCount', 'commentCount', 'queryCount'));
    }
    
    public function blogs()
    {
        $blogs = Blog::orderBy('id', 'DESC')->paginate(10);
        return view('admin.pages.blogs')->with('blogs', $blogs);
    }

    public function write_blog()
    {
        return view('admin.pages.write-blog');
    }

    public function editorFileUpload(Request $request) {
        if($request->hasFile('file')){   
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext = pathinfo($fileNameWithExt, PATHINFO_EXTENSION);
            $fileNameToStore = $fileName . '_' . time() . '.' . $ext;
            $path = $request->file('file')->storeAs('public/cover_images', $fileNameToStore); 
            return response()->json(['fileName'=>$fileNameToStore, 'status'=>true]);
        }
    }

    public function showBlogComments() {
        $comments = BlogComments::orderBy('id', 'DESC')->paginate(10);
        foreach($comments as $comment) {
            $comment['blog'] = Blog::select('title')->where('id', '=', $comment->blog_id)->first();
        }
        return view('admin.pages.show_blog_comments')->with('blogComments', $comments);
    }

    public function deleteComment(Request $request) {
        $ids = $request->input('c_id');
        DB ::table('blog_comments')->whereIn('id', $ids)->delete(); 
        return redirect(url()->previous())->with('success', 'Comment deleted successfully !!');
    }
}
