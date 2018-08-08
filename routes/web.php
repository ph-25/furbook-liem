<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
//hiển thị danh sách các con mèo
Route::get('/', function(){
	return redirect('/cats');
});

Route::get('/cats', function() {
	//echo "danh sach cat";exit;
	//$cats = '<h1>List all cats</h1>';
	$cats = Furbook\Cat::all();

	//cách 1 sử dụng mảng
	//return view('cats/index', array('cats'=>$cats));

	//cách 2 sử dụng compact function
	//return view('cats/index', compact(cats));
	return view('cats/index')->with('cats', $cats);

});

/*//hiển thị chi tiết một con mèo thông qua id
Route::get('/cats/{id}', function($id) {
	return sprintf('Cat #%s', $id);
})->where('id','[0-9]+');
*/
/*Route::get('cats/{id}', function($id){
	$cat = Furbook\Cat::find($id);
	return view('cats.show')->with('cat', $cat);
});*/

//hiển thị thông tin của một con mèo
Route::get('cats/breeds/{name}', function($name){
	$breed = Furbook\Breed::with('cats')
	->where('name', $name)
	->first();
	return view('cats/index')
	->with('breed', $breed)
	->with('cats', $breed->cats);
});

// hiển thị chi tiết một con mèo qua id
Route::get('/cats/{id}', function($id) {
	$cat = Furbook\Cat::find($id);
	return view('cats.show')
		->with('cat', $cat);
})->where('id', '[0-9]+');

//create new cat
Route::get('cats/create', function(){
	return view('cats.create');
});

//insert new cat
Route::post('/cats', function(){
	$data = Request::all();
	$cat = Furbook\Cat::create($data);
	return redirect('/cats/'.$cat->id)
	->withSuccess('Create cat success');
	//dd(Request::all());
});


//edit cat
Route::get('/cats/{id}/edit', function($id){
	$cat = Furbook\Cat::find($id);
	return view ('cats.edit')->with('cat', $cat);
});

Route::put('/cats/{id}', function($id){
	$data = Request::all();
	$cat = Furbook\Cat::find($id);
	$cat->update($data);
	return redirect('/cats/'.$cat->id)
	->withSuccess('Cat has been updated success');
});



