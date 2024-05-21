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

        $this->get('/test-redirect')
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

    /**
     * Route Parameter
     * ● Kadang kita ingin mengirim parameter yang terdapat di bagian dari URL ketika membuat web.
     *   Contoh misal parameter untuk id di URL /products/{productId}
     * ● Laravel mendukung route parameter, dimana kita bisa menambahkan parameter di route url, dan
     *   secara otomatis kita bisa ambil data nya di closure function yang kita gunakan di Route
     * ● Untuk membuat route parameter, kita bisa gunakan {nama}. Kita bisa menambah beberapa route
     *   parameter, asal namanya berbeda
     * ● Data route parameter tersebut akan dikirim secara otomatis pada closure function parameter
     *
     * Regular Expression Constraints
     * ● Kadang ada kalanya kita ingin menggunakan Route Parameter, namun parameternya memiliki pola
     *   tertentu, misal parameternya hanya boleh angka misalnya
     * ● Pada kasus seperti itu, kita bisa menambahkan regular expression di Route Parameter
     * ● Caranya kita bisa gunakan function where() setelah pembuatan Route nya
     *
     * Optional Route Parameter
     * ● Laravel juga mendukung Route Parameter Optional, artinya parameter nya tidak wajib diisi
     * ● Untuk membuat sebuah route parameter menjadi optional, kita bisa tambahkan ? (tanda tanya)
     * ● Namun perlu diingat, jika kita menjadikan route parameter nya optional, maka kita wajib
     *   menambahkan default value di closure function nya
     *
     * Routing Conflict
     * ● Saat membuat router dengan parameter, kadang terjadi conflict routing
     * ● Di Laravel jika terjadi conflict tidak akan menyebabkan error, namun Laravel akan
     *   memprioritaskan router yang pertama kali dibuat
     */

    public function testRouteParameter(){

        $this->get("/products/1")
            ->assertSeeText("Products : 1");

        $this->get("/products/beras/items/5kg")
            ->assertSeeText("Products : beras, Items : 5kg");

    }

    public function testRouteParameterWithRegex(){

        $this->get("/categories/7")
            ->assertSeeText("Categories : 7");

        // jika kita salah masukan route parameter yang sudah di set number, maka akan return Route::fallback()
        $this->get("salah")
            ->assertSeeText("404 Halaman Tidak Ada by Anak Om Mamat");

    }

    public function testRouteOptionalParameter(){

        $this->get("/users/12345")
            ->assertSeeText("Users : 12345");

        $this->get("/users/")
            ->assertSeeText("Users : 404");
    }

    public function testRoutingConflict(){

        /**
         * // mencoba akses route dan route parameter yang di set sama
         * pesan error jika Route Conflict
         * Failed asserting that 'Conflict budhi' contains "Conflict Budhi Octaviansyah".
         */

        $this->get("/conflict/budi")
            ->assertSeeText("Conflict budi");

        $this->get("/conflict/budhi")
            ->assertSeeText("Conflict Budhi Octaviansyah");

    }

    /**
     * Named Route
     * ● Di Laravel, kita bisa menamai Route dengan sebuah nama
     * ● Hal ini bagus ketika kita misal nanti butuh mendapatkan informasi tentang route tersebut, misal
     *   route url nya, atau melakukan redirect ke route
     * ● Dengan menambahkan nama di Route nya, kita bisa menggunakan nama route saja, tanpa khawatir
     *   URL nya akan diubah
     * ● Untuk menambahkan nama di route, kita cukup gunakan function name()
     */

    function testNamedRoute(){

        $this->get("produk/12345")
            ->assertSeeText("link : http://localhost/products/12345");

        $this->get("/product-redirect/12345")
            ->assertRedirect("/products/12345");

    }

}
