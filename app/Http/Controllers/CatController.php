<?php

namespace Furbook\Http\Controllers;

use Illuminate\Http\Request;
use Furbook\Http\Requests\CatRequest;
use Furbook\Cat;
use DB;
use Validator;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DB::enableQueryLog();
        $cats = Cat::all();

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
        $data = $request->all();
        // Define rule of create cat
        $validator = Validator::make(
            $data,
            [
                'name' => 'required|max:255|unique:cats,name',
                'date_of_birth' => 'required|date:"YY-mm-dd"',
                'breed_id' => 'required|numeric'
            ],
            [
                'required' => 'Cột :attribute là bắt buộc.'
            ]
        );
        
        // Check validation
         if ($validator->fails()) {
            return redirect()
                        ->route('cat.create')
                        ->withErrors($validator)
                        ->withInput();
        }
        //create new cat
        $cat = Cat::create($data);
        return redirect()
        ->route('cat.show', $cat->id)
        ->withSuccess('Create cat success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cat $cat)
    {
       // $cat = Furbook\Cat::find($id);
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
        $cat = Cat::find($id);
        return view ('cats.edit')
            ->with('cat', $cat);
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
        $data = $request->all();
        $cat = Cat::find($id);
        $cat->update($data);
        return redirect()
        ->route('cat.show', $cat->id)
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
      
        $cat = Cat::find($id);
       
        $cat->delete();
        return redirect()
        ->route('cat.index')
        ->withSuccess('Delete cat success');
    }
}
