<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContohMiddleware
{
    /**
     * Middleware
     * ● Middleware merupakan cara untuk melakukan filtering terhadap HTTP Request yang masuk ke
     *   aplikasi kita
     * ● Laravel banyak sekali menggunakan middleware, contohnya melakukan enkripsi cookie, verifikasi
     *   CSRF, authentication dan lain-lain
     * ● Semua middleware biasanya disimpan di folder app/Http/Middleware
     *
     * Membuat Middleware
     * ● Untuk membuat middleware, kita bisa gunakan file artisan dengan perintah :
     *   php artisan make:middleware NamaMiddleware
     * ● Middleware mendukung dependency injection, jadi kita bisa menambahkan dependency yang kita
     *   butuhkan di constructor jika memang mau
     * ● Middleware sebenarnya sebuah class sederhana, hanya memiliki method handle(request, closure)
     *   yang akan dipanggil sebelum request masuk ke controller kita
     * ● Jika kita ingin meneruskan ke controller, kita bisa panggil closure(), sedangkan jika tidak, kita bisa
     *   melakukan manipulasi apapun itu di middleware
     * ● Method handle() di middleware bisa mengembalikan Response
     *
     * Global Middleware
     * ● Secara default, middleware tidak akan dieksekusi oleh Laravel, kita perlu meregistrasikan
     *   middleware nya terlebih dahulu ke aplikasi kita
     * ● Kita bisa meregistrasikan middleware dengan beberapa cara
     * ● Pertama kita bisa registrasikan middleware secara global
     * ● Global, artinya middleware akan dieksekusi di semua route, ini kita bisa registrasikan di field
     *   $middleware di Kernel
     *
     * Route Middleware
     * ● Selain global, kita juga bisa registrasikan middleware per route, dimana kita bisa registrasikan
     *   satu-satu, atau bisa langsung buat group middleware
     * ● Untuk registrasikan satu-satu middleware, kita bisa langsung menggunakan class middleware nya,
     *   atau membuat alias di $routeMiddleware di kelas Kernel
     *
     * Middleware Group
     * ● Kadang kita ingin menggabungkan beberapa middleware dalam satu group, sehingga ketika
     *   membutuhkannya, kita cukup sebutkan nama group nya saja
     * ● Laravel mendukung hal tersebut, kita bisa buat nama group dan middleware-middleware yang
     *   tersedia di group tersebut di property $middlewareGroups di kelas Kernel
     * ● Untuk menggunakan middleware group tersebut, kita cukup sebut nama group nya saja
     *
     * Middleware Parameter
     * ● Jika kita ingin menambahkan dependency di middleware, kita bisa manfaatkan dependency
     *   injection di Laravel, namun bagaimana jika kita hanya ingin mengirimkan parameter sederhana saja?
     * ● Kita bisa lakukan itu di handle() method, cukup tambahkan parameter tambahan setelah $next
     *   parameter, dan kita bisa kirim parameter tersebut ketika memanggil middleware nya dengan
     *   menggunakan : (titik dua), lalu jika ada lebih dari satu parameter, gunakan koma sebagai pemisahnya
     *
     * Exclude Middleware
     * ● Sebelumnya kita tahu bahwa di Laravel, terdapat group middleware bernama web dan api, disana
     *   sudah banyak sekali middleware yang sudah secara default disediakan oleh Laravel
     * ● Kadang kita ingin meng-exclude atau membuat middleware di dalam sebuah route, pada kasus
     *   seperti ini kita bisa lakukan ketika menambahkan route
     * ● Kita bisa gunakan method withoutMiddleware() pada Route
     */

    // bawaan middleware laravel
    //public function handle(Request $request, Closure $next)
    //{
    //    $apiKey = $request->header("X-API-KEY"); // get api key dari header
    //    if ($apiKey == "SB") {
    //        return $next($request); // Closure // bisa meneruskan ke middleware
    //    } else {
    //        return response("Access Denied", 401);
    //    }
    //}

    // middleware costum karna ingin menggunakan middleware parameter
    public function handle(Request $request, Closure $next, string $key, int $status)
    {
        $apiKey = $request->header("X-API-KEY"); // get api key dari header
        if ($apiKey == $key) {
            return $next($request); // Closure // bisa meneruskan ke middleware
        } else {
            return response("Access Denied", $status);
        }
    }

}
