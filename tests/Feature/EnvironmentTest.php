<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    /**
     * Environment
     * ● Saat kita membuat aplikasi, kadang kita perlu menyimpan nilai konfigurasi di environment variable
     * ● Laravel memiliki fitur untuk memudahkan kita mengambil data dari environment variable
     * ● Kita bisa menggunakan function env(key) atau Env::get(key) untuk mendapatkan nilai dari
     *   environment variable
     * ● Internal implementasi dari Environment variable di Laravel menggunakan library
     *   https://github.com/vlucas/phpdotenv
     *
     * note: jika ada space gunakan "" jika tidak ada spaci tidak perlu ""
     * // add env di console: export key="value"
     * // export APPNAME="anak om mamat Broo"
     */

    public function testEnvironment(){

        $appName = env("APPNAME"); // env(key) membaca env dari variable di sistem operasi

        $this->assertEquals("Anak Om Mamat Broo", $appName);
    }

    /**
     * File .env
     * ● Selain membaca dari environment variable, Laravel juga memiliki kemampuan untuk membaca nilai
     *   dari file .env yang terdapat di project Laravel
     * ● Ini lebih mudah dibandingkan mengubah environment variable di sistem operasi
     * ● Kita cukup menambah environment variable ke file .env
     * ● File .env secara default di ignore di Git project Laravel, oleh karena itu, kita bisa menambahkan
     *   konfigurasi di local tanpa takut ter-commit ke Git Repository
     *
     * Default Value
     * ● Laravel mendukung default value untuk environment variable
     * ● Default value adalah nilai yang akan digunakan ketika environment variable yang kita ambil tidak tersedia
     * ● Kita bisa menggunakan function env(key, default) atau Env::get(key, default)
     */

    public function testEnvironmentFromFile(){

        //$appName = env("ANAK_OM_MAMAT"); // env(key) // membaca env dari variable di sistem operasi / atau file .env
        $appName = env("ANAK_OM_MAMAT", "asek asek jos"); // env(key, default value) jika env tidak akan di set default value

        $this->assertEquals("anak om mamat", $appName);
    }

    public function testEnvironmentFromFileDefaultValue(){

        //$appName = env("AUTHOR", "jika tidak ada maka diganti dengan value ini"); // env(key, default value) jika env tidak akan di set default value
        $appName =  Env::get("AUTHOR", "jika tidak ada maka diganti dengan value ini"); // Env::get(key, default value) // membaca env dari variable di sistem operasi / atau file .env

        $this->assertEquals("budhi", $appName);
    }

    /**
     * Application Environment
     * ● Saat membuat aplikasi, kadang kita ingin menentukan saat ini sedang berjalan di environment
     *   mana, misal di local, di dev, di staging, di qa atau di production
     * ● Di Laravel, hal ini biasanya dilakukan dengan menggunakan environment variable APP_ENV
     * ● Dan untuk mengecek saat ini sedang berjalan di environment apa, kita bisa menggunakan function
     *   App::environment(value) atau App::environment([value1, value2]), dimana akan return true jika benar
     */

    public function testApplicationEnvironment(){

        // App::environment() // get key (APP_ENV) di file .env
        var_dump(App::environment()); // string(7) "testing"
        if(App::environment(['testing', 'prod', 'dev'])){
            echo "LOGIC IN TESTING ENV" . PHP_EOL; // LOGIC IN TESTING ENV
            // kode program kita
            self::assertTrue(true);
        }
    }
}
