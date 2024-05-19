<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/**
 * Request Lifecycle
 * ● Sebelum kita membuat kode program menggunakan Laravel, ada baiknya kita perlu tahu cara kerja
 *   Laravel itu sendiri
 * ● Terutama bagaimana alur hidup dari request yang kita lakukan ke aplikasi Laravel
 * ● Jika teman-teman sudah mengikuti kelas PHP MVC yang saya buat, harusnya tidak akan terlalu
 *   bingung, karena hampir sama cara kerja nya
 *
 * public/index.php
 * ● Entry point pertama dari aplikasi Laravel adalah sebuah file index.php yang terdapat di folder
 *   public
 * ● Semua request yang masuk ke aplikasi Laravel, maka akan masuk melalui file ini
 * ● File ini sengaja disimpan di dalam folder public tersendiri, agar file-file kode program lainnya tidak
 *   bisa diakses via URL
 * ● Ini file index.php sebenarnya tidak ada yang kompleks, hanya me-load framework Laravel, dan
 *   menjalankan kode program yang kita buat
 *
 * Kernel
 * Dari ../public/index.php, request akan dilanjutkan ke class Kernel
 * class Kernel handle HTTP Kernel, dan Console Kernel
 * ketika request masuk dari web HTTP maka request akan dilanjutkan ke HTTP kernel.  lokasi file class ../app/Http/Kernel.php
 *
 * Service Provider
 * ● Kernel sendiri sebenarnya adalah core dari logic aplikasi, dimana di dalam Kernel, request yang
 *   masuk di tangani sampai mendapatkan response
 * ● Kernel melakukan beberapa hal, pertama Kernel melakukan proses bootstraping, yaitu me-load
 *   yang namanya Service Provider
 * ● Laravel akan melakukan iterasi semua Service Provider dan melakukan proses registrasi dan juga
 *   bootstraping untuk semua Service Provider
 * ● Service Provider ini lah yang bertanggung jawab melakukan bootstraping semua komponen di
 *   Laravel, seperti database, queue, validation, routing dan lain-lain
 */
$kernel = $app->make(Kernel::class); // initialize

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
