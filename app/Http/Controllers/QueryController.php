<?php

namespace App\Http\Controllers;

use App\Query;
use Illuminate\Http\Request;
use Validator;

class QueryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queries = Query::orderBy('id', 'DESC')->paginate(15);
        return view('admin.pages.queries')->with('queries', $queries);         
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
        $validatedQuery =  Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        if ($validatedQuery->fails()) {
            return redirect(url()->previous() . "#contact-form")->withErrors($validatedQuery->errors())->withInput();
        }

        $query = new Query;
        $query->name = $request->input('name');
        $query->email = $request->input('email');
        $query->message = $request->input('message');
        $query->save();

        return redirect(url()->previous())->with('success', '
            <p>Thanks for contacting us for Accounting Support.</p>
            <p>Expect to hear from us shortly.</p>
            <p>In the meantime, check out the Pro Accounting Support <a href="blogs">Blog</a> for in-depth knowledge of QuickBooks Software and know about its error.</p>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function show(Query $query)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function edit(Query $query)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Query $query)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function destroy(Query $query)
    {
        $query->delete();

        return redirect()->back()->with('success', 'Query Deleted Successfully !!');
    }
}
