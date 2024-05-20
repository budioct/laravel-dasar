<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class FacadeTest extends TestCase
{
    /**
     * Facades
     * ● Sebelumnya kita selalu berinteraksi dengan fitur-fitur Laravel menggunakan dependency injection
     * ● Namun kadang ada ketika kita tidak bisa mendapatkan object Application, misal kita membuat
     *   kode di class yang bukan bawaan fitur Laravel, pada kasus seperti ini, Facades sangat membantu
     * ● Facades adalah class yang menyediakan static akses ke fitur di Service Container atau Application
     * ● Laravel menyediakan banyak sekali class Facades, kita akan bahas secara bertahap
     * ● Semua class Facades ada di namespace
     *   https://laravel.com/api/9.x/Illuminate/Support/Facades.html
     *
     * Kapan Menggunakan Facades?
     * ● Selalu gunakan facades jika memang dibutuhkan saja, jika bisa dilakukan menggunakan
     *   dependency injection, selalu gunakan dependency injection
     * ● Terlalu banyak menggunakan Facades akan membuat kita tidak sadar bahwa sebuah class banyak
     *   sekali memiliki dependency, jika menggunakan dependency injection, kita bisa sadar dengan
     *   banyaknya parameter yang terdapat di constructor
     *
     * Facades vs Helper Function
     * ● Di Laravel, selain Facades ada juga Helper Function, bedanya pada Helper Function, tidak
     *   dikumpulkan dalam class
     * ● Contohnya sebelum kita sudah menggunakan Helper Function bernama config() atau env(), itu
     *   adalah Helper function yang terdapat di Laravel
     * ● Penggunaan helper function sebenarnya lebih mudah, namun jika dibandingkan dengan Facades,
     *   maka penggunaan Facades akan lebih mudah dimengerti secara code
     */

    public function testGetConfigWithFacade(){

        $firstName1 = config("contoh.author.firstName"); // config() // method static untuk akses ke file ../bootstrap/cache/config.php
        $firstName2 = Config("contoh.author.secondName"); // Config() // object static dari Facades

        self::assertEquals($firstName1, $firstName2);

        var_dump(Config::all()); // all() // get all isi data file ../bootstrap/cache/config.php

    }

    /***
     * Bagaimana Facades Bekerja?
     * ● Facades sebenarnya adalah class yang menyediakan akses ke dalam dependency yang terdapat di
     *   Service Container
     * ● Semua class Facades adalah turunan dari class Illuminate\Support\Facades\Facade
     * ● Class Facade memiliki sebuah method __callStatic() yang digunakan sebagai magic method yang
     *   akan dipanggil ketika kita memanggil static method di Facade, dan akan meneruskan secara
     *   otomatis ke dependency yang terdapat di Service Container
     * ● Contoh Config::get() sebenarnya akan melakukan pemanggilan method get() di dependency config
     *   di Service Container
     * ● Untuk nama dependency yang terdapat di Container, kita bisa lihat di method getFacadeAccessor()
     *   di class Facade nya
     */

    public function testConfigDependency()
    {
        $config = $this->app->make('config'); // ini yang di lakukan object Facade dia initialize dengan get key config untuk object Config
        $firstName3 = $config->get('contoh.author.first'); // ini yang dilakukan function static Config dari object Facade

        $firstName1 = config('contoh.author.first'); // config() // method static untuk akses ke file ../bootstrap/cache/config.php
        $firstName2 = Config::get('contoh.author.first'); // facade function static pada object Config

        self::assertEquals($firstName1, $firstName2);
        self::assertEquals($firstName1, $firstName3);
        self::assertEquals($firstName2, $firstName3);

        var_dump($config->all()); // all() // get all isi data file ../bootstrap/cache/config.php
    }

    /**
     * Facades Mock
     * ● Salah satu kekurangan menggunakan static function biasanya sulit untuk di test, karena mocking
     *   static function sangat sulit
     * ● Namun untungnya, di Laravel, sudah disediakan function untuk melakukan mocking di Facades,
     *   sehingga kita bisa mudah ketika implementasi unit test
     * ● Laravel menggunakan library Mockery untuk melakukan Mocking Facades
     * ● https://github.com/mockery/mockery
     *
     * Daftar Facades
     * ● Ada banyak Facades di Laravel, dan seperti dijelaskan sebelumnya, hampir semuanya banyak
     *   menggunakan dependency di Service Container
     * ● Untuk lebih jelas tentang ada Facades apa saja, kita bisa lihat di sini :
     *   https://laravel.com/docs/9.x/facades#facade-class-reference
     *
     * Pengenalan Mocking
     * ● Mocking sederhananya adalah membuat object tiruan
     * ● Hal ini dilakukan agar behavior object tersebut bisa kita tentukan sesuai dengan keinginan kita
     * ● Dengan mocking, kita bisa membuat request response seolah-olah object tersebut benar dibuat
     */

    public function testFacadeMocking()
    {
        // shouldReceive('method static') // method static facade object Config, seolah olah persis seperti object aslinya
        // with(key) // key yang di akses dari file config.php, seolah olah persis seperti akses di file confignya
        // andReturn(value) // value yang di set, seolah olah persis seperti isi file aslinya
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('budhi asek');

        $firstName = Config::get('contoh.author.first');

        self::assertEquals('budhi asek', $firstName);
    }

}
