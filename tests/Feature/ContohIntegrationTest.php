<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohIntegrationTest extends TestCase
{
    /**
     * Testing
     * ● Laravel menggunakan PHPUnit untuk implementasi unit test nya
     * ● Secara garis besar, di Laravel terdapat dua jenis test, unit test dan feature test / integration test
     *
     * Integration Test
     * ● Laravel memiliki fitur yang mempermudah kita ketika membuat integration test
     * ● Bedanya dari unit test, di integration test, aplikasi laravel bisa diakses dengan mudah, misal kita
     *   nanti mau memanggil Database, Controller, dan lain-lain
     * ● Untuk membuat Integration Test, kita cukup membuat class turunan dari
     *   Illuminate\Foundation\Testing\TestCase
     * ● Integration Test akan lebih lambat dibandingkan Unit Test, karena kita butuh me-load framework
     *   Laravel terlebih dahulu
     * ● Dan jika kita membutuhkan fitur Laravel, maka kita wajib menggunakan Integration Test
     *
     * Membuat Test
     * ● Untuk membuat Integration Test, kita bisa lakukan manual, atau kita bisa gunakan file artisan
     *
     * menggunakan perintah : php artisan make:test NamaTest
     *
     * ● Secara otomatis akan masuk ke folder tests/Feature
     *
     * Menjalankan Test
     * ● Untuk menjalankan test, kita bisa gunakan PHPUnit seperti biasanya
     * ● Atau jika ingin menjalankan semua test, bisa menggunakan file artisan dengan perintah : php artisan test
     */

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


}
