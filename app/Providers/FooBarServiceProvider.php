<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\ServicesImpl\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     *  bindings & singletons Properties
     *  ● Jika kita hanya butuh melakukan binding sederhana, misal dari interface ke class, kita bisa
     *    menggunakan fitur binding via properties di Service Provider
     *  ● Kita bisa tambahkan property bindings untuk membuat binding, atau
     *  ● Menggunakan property singletons untuk membuat binding singleton
     */

    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];

    /**
     * Service Provider
     * ● Sekarang kita sudah tahu untuk melakukan dependency injection di Laravel, sekarang
     *   pertanyaannya apakah ada best practice dimana melakukan dependency injection tersebut?
     * ● Laravel menyediakan fitur bernama Service Provider, dari namanya kita tahu bahwa ini adalah
     *   penyedia service atau dependency
     * ● Di dalam Service Provider, biasanya kita melakukan registrasi dependency di dalam Service Container
     * ● Bahkan semua proses bootstraping atau pembentukan object-object di framework Laravel itu
     *   sendiri dilakukan di ServiceProvider, kita bisa lihat saat pertama kali membuat project Laravel, ada
     *   banyak sekali file ServiceProvider di namespace App\Providers
     *
     * Membuat Service Provider menggunakan perintah :
     * php artisan make:provider NamaServiceProvider
     *
     * Service Provider Function
     * ● Di dalam Service Provider terdapat dua function, yaitu register() dan boot()
     * ● Di register(), kita harus melakukan registrasi dependency yang dibutuhkan ke Service Container,
     *   jangan melakukan kode selain registrasi dependency di function register(), jika tidak ingin
     *   mengalami error dependency belum tersedia
     * ● Function boot() dipanggil setelah register() selesai, di sini kita bisa melakukan hal apapun yang
     *   diperlukan setelah proses registrasi dependency selesai
     *
     * Registrasi Service Provider
     * ● Setelah kita membuat Service Provider, secara default Service Provider tidak diload oleh Laravel
     * ● Untuk memberi tahu Laravel jika kita ingin menambahkan Service Provider, kita perlu
     *   menambahkannya pada config di app.php, terdapat key providers yang berisi class-class Service
     *   Provider yang akan dijalankan oleh Laravel
     *
     * setelah itu update bootstrap/cache/config.php..
     * dengan pertinah
     *  - php artisan config:clear (menghapus config sebelumnya)
     *  - php artisan config:cache (membuat config perubahan yang baru)
     */

    public function register()
    {
        // dependency injection dengan cara Service Container
        // class Application memrepresentasikan $app Di semua project Laravel
        // kita tidak perlu initialize object dengan keyword new
        // cukup dengan function make(key/class), bind(key, closure), singleton(key, closure) instance(key, object)
        // class Application untuk membuat dependency secara otomatis

        //echo "FooBarServiceProvider";

        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app){
            return new Bar($app->make(Foo::class)); // class Foo yang dependency injection ke class Bar
        });
    }

    public function boot()
    {
        //
    }

    /**
     *  Deferred Provider
     *  ● Secara default semua Service Provider akan di load oleh Laravel, baik itu kita butuhkan atau tidak
     *  ● Laravel memiliki fitur bernama Deferred Provider, dimana kita bisa menandai sebuah Service
     *    Provider agar tidak di load jika tidak dibutuhkan dependency nya
     *  ● Kita bisa menandai Service Provider kita dengan implement interface DeferrableProvider, lalu
     *    implement method provides() yang memberi tahu tipe dependency apa saja yang terdapat di
     *    Service Provider ini
     *  ● Dengan fitur ini, Service Provider hanya akan di load ketika memang dependency nya dibutuhkan
     *  ● Setiap ada request baru, maka Serive Provider yang sudah Deffered tidak akan di load jika memang
     *    tidak dibutuhkan
     *
     *  sebelumnya hapus dulu bootstrap service sebelumnya dengan perintah:
     *  php artisan clear-compiled
     *
     * note: di ../bootstrap/cache/service.php
     * jika kita ingin Dependency injection dari service provider itu lazy gunakan Deferred Provider dia akan masuk ke 'deferred' => array ()
     * jika tidak menggunakan Deferred Provider dia akan masuk ke Eager  'eager' => array ()
     */

    public function provides() : array
    {
        return [HelloService::class, Foo::class, Bar::class];
    }

}
