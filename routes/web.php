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
use Furbook\Breed;
DB::enableQueryLog();
/*Route::get('/', function () {
    return view('welcome');
});*/
//homepage
//hiển thị danh sách các con mèo
Route::get('/', function(){
	return redirect('/cats');
});

Route::group(['middleware' => 'auth'], function(){
	Route::get('/cats', ['uses' => 'CatController@index', 'as' => 'cat.index']);
	
	//hiển thị thông tin của một con mèo
	Route::get('cats/breeds/{name}', function($name){
		$breed = Breed::with('cats')
		->where('name', $name)
		->first();
		return view('cats/index')
		->with('breed', $breed)
		->with('cats', $breed->cats);
	});
	// hiển thị chi tiết một con mèo qua id
	Route::get('/cats/{cat}', ['uses' => 'CatController@show', 'as' => 'cat.show'])->where('cat', '[0-9]+');

	//create new cat
	Route::get('cats/create', ['uses' => 'CatController@create', 'as' => 'cat.create']);

	//insert new cat
	Route::post('/cats', ['uses' => 'CatController@store', 'as' => 'cat.store']);

	//edit cat
	Route::get('/cats/{cat}/edit', ['uses' => 'CatController@edit', 'as' => 'cat.edit']);

	Route::put('/cats/{cat}', ['uses' => 'CatController@update', 'as' => 'cat.update']);

	//delete cat
	Route::delete('cats/{id}', ['uses' => 'CatController@destroy', 'as' => 'cat.destroy']);
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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
