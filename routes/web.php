<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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
Route::get('/search','PagesController@search')->name('search');
Route::get('/certs','ProgramsController@getCerts')->name('certificates.get');

Route::get('/', 'PagesController@home')->name('pages.home');
Route::get('/o-kompanii', 'PagesController@about')->name('pages.about');

Route::get('/o-kompanii/nashi-proekty','ProjectsController@index')->name('projects.index');
Route::get('/o-kompanii/nashi-proekty/{project}','ProjectsController@show')->name('projects.show');

Route::get('/o-kompanii/obuchenie','ProgramsController@index')->name('programs.index');
Route::get('/o-kompanii/obuchenie/{program}','ProgramsController@show')->name('programs.show');

Route::get('/o-kompanii/{page}', 'PagesController@show')->name('about.show');

Route::get('/poleznaya-informaciya', 'InfosController@index')->name('info.index');
Route::get('/poleznaya-informaciya/{page}', 'InfosController@show')->name('info.show');
//Route::get('/poleznaya-informaciya/dostavka', 'InfosController@delivery')->name('info.delivery');
//Route::get('/poleznaya-informaciya/oplata', 'InfosController@payment')->name('info.payment');

Route::get('/novosti','PostsController@index')->name('posts.index');
Route::get('/novosti/{post}','PostsController@show')->name('posts.show');

Route::get('/kontakty','PagesController@contacts')->name('pages.contacts');

Route::get('/catalog','CatalogController@index')->name('catalog.index');
Route::get('/catalog/getCurrent/{slug}','CatalogController@getCurrentCategory');
Route::get('/catalog/{categoryId}/products','CatalogController@getAjaxProducts')->name('catalog.ajax.products');
Route::get('/catalog/{category}/{cats?}',[\App\Http\Controllers\CatalogController::class,'showCatalog'])->name('catalog.show')
    ->where('cats','^[a-zA-Z0-9-_\/]+$');

Route::post('/feedback/inline','PagesController@popupCallback')->name('feedback.inline');
Route::post('/subscribe','PagesController@newSubscriber')->name('subscribe');
Route::get('/karta-saita','PagesController@sitemapPage')->name('sitemap');
Route::get('/terms','PagesController@terms')->name('page.terms');
Route::get('/locale/{lang}','PagesController@setLocale')->name('locale.set');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
