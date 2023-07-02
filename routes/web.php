<?php

use App\Http\Controllers\CategoryController as CategoryControllerAlias;
use App\Http\Controllers\PostController as PostControllerAlias;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post( 'posts/{id}/restore', [ PostControllerAlias::class, 'restore' ] )->name( 'posts.restore' );
Route::post( 'posts/{id}/force_delete', [ PostControllerAlias::class, 'forceDelete' ] )->name( 'posts.force_delete' );
Route::post( 'posts/{id}/delete', [ PostControllerAlias::class, 'delete' ] )->name( 'posts.delete' );
Route::get( '/', [ PostControllerAlias::class, 'view' ] );
Route::get( '/categories/{id}/posts', array( CategoryControllerAlias::class, 'getPostsByCategory' ) )->name( 'category.getPosts' );
