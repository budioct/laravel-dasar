<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptTest extends TestCase
{

    /**
     * Encryption
     * ● Laravel memiliki abstraction fitur untuk melakukan encryption, dengan ini kita tidak perlu
     *   melakukan enkrip dan dekrip secara manual, kita bisa memanfaatkan fitur ini
     * ● Untuk melakukan enkripsi, Laravel membutuhkan key, dimana key tersebut disimpan di
     *   config/app.php
     * ● Secara default, Laravel akan mengambil key tersebut dari environment APP_KEY, kita bisa cek di
     *   file .env
     *
     * Membuat Encryption Key
     * ● Key untuk enkripsi hendaknya dibuat secara random dan secara berkala di ubah
     * ● Dan untuk membuat key enkripsi secara random, kita tidak perlu buat secara manual, kita bisa
     *   menggunakan bantuan file artisan dengan perintah :  php artisan key:generate
     * ● Secara otomatis akan mengisi key APP_KEY di file .env
     *
     * Melakukan Enkrip dan Dekrip
     * ● Untuk melakukan enkrip dan dekrip, kita bisa menggunakan Facade Crypt
     * ● https://laravel.com/api/9.x/Illuminate/Support/Facades/Crypt.html
     */

    public function testEncrypt(){

        $encrypt = Crypt::encrypt("rahasia"); // hashing
        $decrypt = Crypt::decrypt($encrypt);

        var_dump($encrypt);
        var_dump($decrypt);

        self::assertEquals("rahasia", $decrypt);

    }

}
