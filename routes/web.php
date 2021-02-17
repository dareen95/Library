<?php

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
Route::middleware('setLang')->group(function(){




    Route::get('/', function () {
        return view('welcome');
    })->name('message');

    Route::post('/message/send', 'MessageController@send')->name('message.send');


    /* Authentication */
    //register
    Route::get('/register', 'AuthController@register')->name('auth.register');
    Route::post('/handle-register', 'AuthController@handleRegister')->name('auth.handleRegister');

    //login
    Route::get('/login', 'AuthController@login')->name('auth.login');
    Route::post('/handle-login', 'AuthController@handleLogin')->name('auth.handleLogin');


    Route::middleware('userAuth')->group(function() {

        //logout
        Route::get('/logout', 'AuthController@logout')->name('auth.logout');

        Route::middleware('isAdmin')->group(function() {
            //Delete Authors
            Route::get('/authors/delete/{id}', 'AuthorController@delete')->name('deleteAuthors');

            //Delete Books
            Route::get('/books/delete/{id}', 'BookController@delete')->name('Books.delete');

            //Delete categories
            Route::get('/categories/delete/{id}', 'CategoryController@delete')->name('categories.delete');


            //Create Authors
            Route::get('/authors/create', 'AuthorController@create')->name('createAuthors');
            Route::post('/authors/store', 'AuthorController@store')->name('storeAuthors');

            // Update Authors
            Route::get('/authors/edit/{id}', 'AuthorController@edit')->name('editAuthors');
            Route::post('/authors/update/{id}', 'AuthorController@update')->name('updateAuthors');

            //Create Books
            Route::get('/books/create', 'BookController@create')->name('Books.create');
            Route::post('/books/store', 'BookController@store')->name('Books.store');

            // Update Books
            Route::get('/books/edit/{id}', 'BookController@edit')->name('Books.edit');
            Route::post('/books/update/{id}', 'BookController@update')->name('Books.update');

            //Create categories
            Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
            Route::post('/categories/store', 'CategoryController@store')->name('categories.store');

            // Update categories
            Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
            Route::post('/categories/update/{id}', 'CategoryController@update')->name('categories.update');

        });

        //Read notes
        Route::get('/notes', 'NoteController@index')->name('notes.index');

        //Create notes
        Route::get('/notes/create', 'NoteController@create')->name('notes.create');
        Route::post('/notes/store', 'NoteController@store')->name('notes.store');

        // Update Books
        Route::get('/notes/edit/{id}', 'NoteController@edit')->name('notes.edit');
        Route::post('/notes/update/{id}', 'NoteController@update')->name('notes.update');

        //Delete notes
        Route::get('/notes/delete/{id}', 'NoteController@delete')->name('notes.delete');

    });


    /* Authors */

    // Read Authors
    Route::get('/authors', 'AuthorController@index')->name('allAuthors');
    Route::get('/authors/latest', 'AuthorController@latest')->name('latestAuthors');
    Route::get('/authors/show/{id}', 'AuthorController@show')->name('showAuthor');
    Route::get('/authors/search/{word}', 'AuthorController@search')->name('searchAuthors');


    /* Books */

    // Read Books
    Route::get('/books', 'BookController@index')->name('allBooks');
    // Route::get('/books/latest', 'BookController@latest')->name('latestBooks');
    Route::get('/books/show/{book}', 'BookController@show')->name('showBooks');
    // Route::get('/books/search/{word}', 'BookController@search')->name('searchBooks');

    //AJAX get request for real time search
    Route::get('/books/search', 'BookController@search')->name('books.search');



    /* categories */

    //Read categories
    Route::get('/categories', 'CategoryController@index')->name('categories.index');
    Route::get('/categories/show/{id}', 'CategoryController@show')->name('categories.show');


    //Oauth
    Route::get('login/github', 'AuthController@redirectToProviderGithub')->name('auth.github.redirect');
    Route::get('login/github/callback', 'AuthController@handleProviderCallbackGithub')->name('auth.github.callback');

    Route::get('login/facebook', 'AuthController@redirectToProviderFacebook')->name('auth.facebook.redirect');
    Route::get('login/facebook/callback', 'AuthController@handleProviderCallbackFacebook')->name('auth.facebook.callback');

    Route::get('login/google', 'AuthController@redirectToProviderGoogle')->name('auth.google.redirect');
    Route::get('login/google/callback', 'AuthController@handleProviderCallbackGoogle')->name('auth.google.callback');

    Route::get('/lang/ar', 'LangController@ar')->name('lang.ar');
    Route::get('/lang/en', 'LangController@en')->name('lang.en');

    // Route::get('/lang/{lang}', 'LangController@en')->name('lang');

});


//Route::group(['prefix' => 'users', 'middleware' => 'auth'], function(){

//})
