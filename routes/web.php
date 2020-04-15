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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/testing', 'TestingController@index');

Route::get('locale/{locale}',function ($locale){
	Session::put('locale', $locale);
	return redirect()->back();
});



Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

/*************************** Story ***************************/
Route::get('admin/story', 'Admin\StoryController@index')->name('admin.story')->middleware('is_admin');
Route::post('admin/story/store', 'Admin\StoryController@store')->name('admin.story.store')->middleware('is_admin');
Route::get('admin/story/listing', 'Admin\StoryController@show')->name('admin.story.listing')->middleware('is_admin');
Route::get('admin/story/delete/{id}', 'Admin\StoryController@destroy')->name('admin.story.destroy')->middleware('is_admin');
Route::get('admin/story/edit/{id}', 'Admin\StoryController@edit')->name('admin.story.edit')->middleware('is_admin');
Route::post('admin/story/update', 'Admin\StoryController@update')->name('admin.story.update')->middleware('is_admin');

/*************************** Orphan Category ***************************/
Route::get('admin/orphan', 'Admin\OrphanCategoryController@index')->name('admin.orphan')->middleware('is_admin');
Route::post('admin/orphan/store', 'Admin\OrphanCategoryController@store')->name('admin.orphan.store')->middleware('is_admin');
Route::get('admin/orphan/listing', 'Admin\OrphanCategoryController@show')->name('admin.orphan.listing')->middleware('is_admin');
Route::get('admin/orphan/delete/{id}', 'Admin\OrphanCategoryController@destroy')->name('admin.orphan.destroy')->middleware('is_admin');
Route::get('admin/orphan/edit/{id}', 'Admin\OrphanCategoryController@edit')->name('admin.orphan.edit')->middleware('is_admin');
Route::post('admin/orphan/update', 'Admin\OrphanCategoryController@update')->name('admin.orphan.update')->middleware('is_admin');

/*************************** Orphan Basic Care ***************************/
Route::get('admin/basic_care', 'Admin\OrphanDetailController@index')->name('admin.basic_care')->middleware('is_admin');
Route::post('admin/basic_care/store', 'Admin\OrphanDetailController@store')->name('admin.basic_care.store')->middleware('is_admin');
Route::get('admin/basic_care/listing', 'Admin\OrphanDetailController@show')->name('admin.basic_care.listing')->middleware('is_admin');
Route::get('admin/basic_care/delete/{id}', 'Admin\OrphanDetailController@destroy')->name('admin.basic_care.destroy')->middleware('is_admin');

/*************************** Orphan Student ***************************/
Route::get('admin/orphan/student', 'Admin\OrphanStudentController@index')->name('admin.orphan.student')->middleware('is_admin');
Route::post('admin/orphan/student/store', 'Admin\OrphanStudentController@store')->name('admin.orphan.student.store')->middleware('is_admin');
Route::get('admin/orphan/student/listing', 'Admin\OrphanStudentController@show')->name('admin.orphan.student.listing')->middleware('is_admin');
Route::get('admin/orphan/student/delete/{id}', 'Admin\OrphanStudentController@destroy')->name('admin.orphan.student.destroy')->middleware('is_admin');
Route::get('admin/orphan/student/edit/{id}', 'Admin\OrphanStudentController@edit')->name('admin.orphan.student.edit')->middleware('is_admin');
Route::post('admin/orphan/student/update', 'Admin\OrphanStudentController@update')->name('admin.orphan.student.update')->middleware('is_admin');

/*************************** Story ***************************/
Route::get('admin/secratory_general', 'Admin\SecratoryGeneralController@index')->name('admin.secratory_general')->middleware('is_admin');
Route::post('admin/secratory_general/store', 'Admin\SecratoryGeneralController@store')->name('admin.secratory_general.store')->middleware('is_admin');
Route::get('admin/secratory_general/listing', 'Admin\SecratoryGeneralController@show')->name('admin.secratory_general.listing')->middleware('is_admin');
Route::get('admin/secratory_general/edit/{id}', 'Admin\SecratoryGeneralController@edit')->name('admin.secratory_general.edit')->middleware('is_admin');
Route::post('admin/secratory_general/update', 'Admin\SecratoryGeneralController@update')->name('admin.secratory_general.update')->middleware('is_admin');

/*************************** Gallery ***************************/
Route::get('admin/gallery', 'Admin\GalleryController@index')->name('admin.gallery')->middleware('is_admin');
Route::post('admin/gallery/store', 'Admin\GalleryController@store')->name('admin.gallery.store')->middleware('is_admin');
Route::get('admin/gallery/listing', 'Admin\GalleryController@show')->name('admin.gallery.listing')->middleware('is_admin');
Route::get('admin/gallery/delete/{id}', 'Admin\GalleryController@destroy')->name('admin.gallery.destroy')->middleware('is_admin');
Route::get('admin/gallery/edit/{id}', 'Admin\GalleryController@edit')->name('admin.gallery.edit')->middleware('is_admin');
Route::post('admin/gallery/update', 'Admin\GalleryController@update')->name('admin.gallery.update')->middleware('is_admin');

/*************************** Project Detail ***************************/
Route::get('admin/project_detail', 'Admin\ProjectDetailController@index')->name('admin.project_detail')->middleware('is_admin');
Route::post('admin/project_detail/store', 'Admin\ProjectDetailController@store')->name('admin.project_detail.store')->middleware('is_admin');
Route::get('admin/project_detail/listing', 'Admin\ProjectDetailController@show')->name('admin.project_detail.listing')->middleware('is_admin');
Route::get('admin/project_detail/delete/{id}', 'Admin\ProjectDetailController@destroy')->name('admin.project_detail.destroy')->middleware('is_admin');
Route::get('admin/project_detail/edit/{id}', 'Admin\ProjectDetailController@edit')->name('admin.project_detail.edit')->middleware('is_admin');
Route::post('admin/project_detail/update', 'Admin\ProjectDetailController@update')->name('admin.project_detail.update')->middleware('is_admin');
Route::post('admin/project_detail/image_upload', 'Admin\ProjectDetailController@upload')->name('upload');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
