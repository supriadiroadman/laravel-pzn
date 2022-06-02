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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/srs', function () {
    return "Hello Supriadi Roadman";
});

Route::redirect('/youtube', '/srs');

Route::fallback(function () {
    return "404 By Supriadi";
});

Route::view('/hello', 'hello', ['name' => 'Supriadi']);

Route::get('hello-again', function () {
    return view('hello', ['name' => "Supriadi"]);
});

Route::get('hello-world', function () {
    return view('hello.world', ['name' => "Supriadi"]);
});

Route::get('/products/{id}', function ($productId) {
    return "Product $productId";
});

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
});

Route::get('/categories/{id}', function ($categoryId) {
    return "Category $categoryId";
})->where('id', "[0-9]+");

Route::get('/users/{id?}', function (string $userId = '404') {
    return "User $userId";
});

Route::get('/conflict/adi', function () {
    return "Conflict Supriadi Roadman Siagian";
});

Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});
