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

/**
 * Routing
 * ● Routing adalah proses menerima HTTP Request dan menjalankan kode sesuai dengan URL yang
 *   diminta. Routing biasanya tergantung dari HTTP Method dan URL
 * ● Salah satu Service Provider yang paling penting di Laravel adakah RouteServiceProvider.
 * ● RouteServiceProvider bertanggung jawab untuk melakukan load data routing dari folder routes.
 *   Jika kita hapus Service Provider ini, secara otomatis proses routing tidak akan berjalan
 * ● RouteServiceProvider secara default akan me-load data routing dari folder routes
 *
 * Basic Routing
 * ● Salah satu contoh routing yang paling sederhana adalah menggunakan path dan juga closure
 *   function sebagai handler nya
 * ● Kita bisa menggunakan Facades Route, lalu menggunakan function sesuai dengan HTTP Methodnya, misal:
 * ○ Route::get($uri, $callback);
 * ○ Route::post($uri, $callback);
 * ○ Route::put($uri, $callback);
 * ○ Route::patch($uri, $callback);
 * ○ Route::delete($uri, $callback);
 * ○ Route::options($uri, $callback);
 *
 * Redirect
 * ● Router juga bisa digunakan untuk melakukan redirect dari satu halaman ke halaman lain
 * ● Kita bisa menggunakan function Route::redirect(from, to)
 *
 * Melihat Semua Routing
 * ● Kadang kita ada kebutuhan melihat semua Routing yang ada di aplikasi Laravel kita
 * ● Untuk melihatnya, kita bisa memanfaatkan file artisan dengan perintah :
 *   php artisan route:list
 *
 * Fallback Route
 * ● Apa yang terjadi jika kita melakukan request ke halaman yang tidak ada di aplikasi Laravel kita?
 *   Secara otomatis akan mengembalikan error 404
 * ● Kadang-kadang kita ingin mengubah tampilan halaman error ketika halaman yang diakses tidak ada
 * ● Pada kasus seperti ini, kita bisa membuat fallback route, yaitu callback yang akan dieksekusi ketika
 *   tidak ada route yang cocok dengan halaman yang diakses
 * ● Kita bisa menggunakan function Route::fallback(closure)
 */

// http method get
Route::get('/', function () {
    return view('welcome');
});

Route::get("/test", function (){
    return "<b>ini adalah halaman test</b>";
});

Route::get("/ommamat", function (){
   return "<h1>HALAMAN ANAK OM MAMAT </h1>";
});

// http redirect halaman
Route::redirect("/test", "ommamat");

// response fallback route (jika tidak path route maka anak di tampilkan halaman ini)
Route::fallback(function (){
    return "<h1>404 Halaman Tidak Ada<br> by Anak Om Mamat</h1>";
});
