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

Route::get('/cats',['use'=>'CatController@index', 'as'=>'cat.index']);
	//echo "danh sach cat";exit;
	//$cats = '<h1>List all cats</h1>';
	



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
Route::get('/cats/{id}', ['use'=>'CatController@show', 'as'=>'cat.show'])->where('id', '[0-9]+');

//create new cat
Route::get('cats/create',['use'=>'CatController@create', 'as'=>'cat.create']);

//insert new cat
Route::post('/cats', ['use'=>'CatController@store', 'as'=>'cat.store']);


//edit cat
Route::get('/cats/{id}/edit', ['use'=>'CatController@edit', 'as'=>'cat.edit']);

Route::put('/cats/{id}', ['use'=>'CatController@update', 'as'=>'cat.update']);

//delete cat
Route::delete('cats/{id}', 'CatController@destroy');



