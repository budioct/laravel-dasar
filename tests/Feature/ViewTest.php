<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{

    /**
     * View
     * ● Membuat response dari Route itu sangat mudah, tapi jika misal kita ingin membuat response yang
     *   kompleks seperti HTML, maka akan sulit jika kita lakukan di Route
     * ● View adalah fitur di Laravel yang digunakan untuk mempermudah dalam pembuatan tampilan
     *   halaman web HTML
     * ● Dengan View, kita bisa membedakan lokasi logic aplikasi, dengan kode tampilan
     * ● Semua View disimpan di folder resources/views
     *
     * Blade Templating
     * ● Laravel menggunakan template engine yang bernama Blade untuk membuat kode View nya, jadi
     *   tidak seperti kode PHP biasanya
     * ● Detail tentang materi Blade Templating, akan kita bahas di kelas terpisah khusus membahas
     *   tentang Blade Templating
     * ● Pada materi ini kita hanya akan bahas dasar-dasar nya saja
     * ● Blade menggunakan extension blade.php sebagai penamaan file nya, misal index.blade.php
     *
     * Blade Variable
     * ● Salah satu keuntungan menggunakan template dibanding kode PHP langsung adalah, kita bisa
     *   memaksa programmer untuk memisahkan logic kode program dengan tampilan (di template)
     * ● Di Blade, walaupun kita bisa membuat kode PHP, tapi tidak disarankan menggunakan itu
     * ● Cara yang direkomendasikan adalah, kita hanya membuat variable di template blade, lalu mengirim
     *   variable tersebut dari luar ketika akan menampilkan template nya
     * ● Untuk membuat menampilkan variable di blade template, kita bisa gunakan {{ $nama }}, dinama
     *   nanti variable $nama bisa diambil secara otomatis dari data yang kita kirim ketika menampilkan view blade nya
     *
     * Rendering View
     * ● Setelah kita membuat View, selanjutnya untuk me-render (menampilkan) View tersebut di dalam
     *   Router, kita bisa menggunakan function Route::view(uri, template, array) atau menggunakan
     *   view(template, array) di dalam closure function Route
     * ● Dimana template adalah nama template, tanpa menggunakan blade.php, dan array berisikan data
     *   variable yang ingin kita gunakan
     *
     * Nested View Directory
     * ● View juga bisa disimpan di dalam directory lagi di dalam directory views
     * ● Hal ini baik ketika kita sudah banyak membuat views, dan ingin melakukan management file views
     * ● Namun ketika kita ingin mengambil views nya, kita perlu ganti menjadi titik, tidak menggunakan / (slash)
     * ● Misal jika kita buat views di folder admin/profile.blade.php, maka untuk mengaksesnya kita
     *   gunakan admin.profile
     *
     * Optimizing Views
     * ● Secara default, Blade Template di compile menjadi kode PHP ketika ketika ada request, Laravel
     *   akan mengecek apakah hasil compile Blade Template ada atau tidak, jika ada maka akan
     *   menggunakannya, jika tidak ada maka akan coba melakukan compile.
     * ● Termasuk Laravel juga akan mendeteksi ketika ada perubahan Blade Template.
     * ● Kompilasi ketika request masuk akan ada efek buruknya, yaitu performanya jadi lambat karena
     *   harus melakukan kompilasi. Oleh karena itu ketika nanti menjalankan aplikasi Laravel di
     *   production, ada baiknya melakukan proses kompilasi seluruh blade template terlebih dahulu, agar
     *   tidak perlu melakukan kompilasi lagi ketika request masuk
     *
     * Compiling View
     * ● Untuk melakukan compile view atau blade template, kita bisa gunakan perintah :
     *   php artisan view:cache
     * ● Semua hasil compile view akan disimpan di folder storage/framework/views
     * ● Jika kita ingin menghapus seluruh hasil compile, kita bisa gunakan perintah
     *   php artisan view:clear
     *
     * Test View Tanpa Routing
     * ● Kadang kita juga ingin membuat View tanpa routing, misal untuk mengirim email misalnya
     * ● Pada kasus ini, kita bisa melakukan test view secara langsung, tanpa harus membuat Route terlebih
     *   dahulu
     */

    public function testView()
    {
        $this->get("/hello")
            ->assertSeeText("Hello Anak Om Mamat");

        $this->get("/hello-again")
            ->assertSeeText("Hello Anak Om Mamat");

    }

    public function testViewNested()
    {
        $this->get("/world")
            ->assertSeeText("Page World!")
            ->assertSeeText("World Anak Om Mamat");

        $this->get("/world-again")
            ->assertSeeText("World Anak Om Mamat");

    }

    public function testViewWithoutRoute()
    {
        $this->view("hello", ["name" => "Anak Om Mamat"])
            ->assertSeeText("Hello Anak Om Mamat");

        $this->view("hello.world", ["name" => "Anak Om Mamat"])
            ->assertSeeText("World Anak Om Mamat");
    }

}
