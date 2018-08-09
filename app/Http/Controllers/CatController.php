<?php

namespace Furbook\Http\Controllers;

use Illuminate\Http\Request;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Furbook\Cat::all();

    //cách 1 sử dụng mảng
    //return view('cats/index', array('cats'=>$cats));

    //cách 2 sử dụng compact function
    //return view('cats/index', compact(cats));
         return view('cats/index')->with('cats', $cats);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Request::all();
        $cat = Furbook\Cat::create($data);
        return redirect()
        ->route('cat.store', $cat->id)
        ->withSuccess('Create cat success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Furbook\Cat::find($id);
        return view('cats.show')
        ->with('cat', $cat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Furbook\Cat::find($id);
        return view ('cats.edit')->with('cat', $cat);
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
        $data = Request::all();
        $cat = Furbook\Cat::find($id);
        $cat->update($data);
        return redirect('/cats/'.$cat->id)
        ->withSuccess('Cat has been updated success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Furbook\Cat::find($id);
        $cat->delete();
        return redirect('/cats')
        ->withSuccess('Delete cat success');
    }
}
