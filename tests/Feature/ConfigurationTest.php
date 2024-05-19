<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * Mengambil Konfigurasi
     * ● Untuk mengambil konfigurasi di file konfigurasi, kita bisa menggunakan function config(key, default)
     * ● Dimana pembuatan key pada config diawali dengan nama file, lalu diikuti dengan key yang terdapat
     *   di dalam return value nya
     * ● Tiap nested array menggunakan . (titik)
     * ● Misal contoh.author.first, artinya kita ambil konfigurasi dari file contoh.php, lalu ambil data array
     *   key author, dan di dalamnya kita ambil data key first
     * ● Sama seperti function env(), function config() juga memiliki parameter default value jika key
     *   konfigurasinya tidak tersedia
     */

    public function testGetConfigContoh(){

        $firstName = config("contoh.author.first"); // config() // untuk mengambil value pada file yang ada di folder /config
        $lastName = config("contoh.author.last"); // contoh.author.last // contoh = nama file , author = array object , last = nested array object
        $email = config("contoh.email");
        $web = config("contoh.web");

        self::assertEquals("budhi", $firstName);
        self::assertEquals("octaviansyah", $lastName);
        self::assertEquals("budioct@test.com", $email);
        self::assertEquals("http://anakommamat.com/", $web);
    }
}
