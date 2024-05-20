<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RoutingTest extends TestCase
{

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

    public function testRoutingGet(){

        $this->get('/test')
            ->assertStatus(200)
            ->assertseeText('ini adalah halaman test');

    }

    public function testRoutingGetDua(){

        $this->get('/ommamat')
            ->assertStatus(200)
            ->assertseeText('HALAMAN ANAK OM MAMAT');

    }

    public function testRedirectPage(){

        $this->get('/test')
            ->assertStatus(302)
            ->assertRedirect('/ommamat');

    }

    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertStatus(200)
            ->assertSeeText('404 Halaman Tidak Ada by Anak Om Mamat');

        $this->get('/tidakadalagi')
            ->assertStatus(200)
            ->assertSeeText('404 Halaman Tidak Ada by Anak Om Mamat');

        $this->get('/ups')
            ->assertStatus(200)
            ->assertSeeText('404 Halaman Tidak Ada by Anak Om Mamat');
    }



}
