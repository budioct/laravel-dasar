<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ContohUnitTest extends TestCase
{
    /**
     * Testing
     * ● Laravel menggunakan PHPUnit untuk implementasi unit test nya
     * ● Secara garis besar, di Laravel terdapat dua jenis test, unit test dan feature test / integration test
     *
     * Unit Test
     * ● Untuk unit test, kita bisa membuat class unit test seperti menggunakan PHP Unit biasanya
     * ● Yaitu dengan membuat class turunan dari PHPUnit\Framework\TestCase
     * ● Jika kita perlu membuat test tanpa harus menggunakan fitur Laravel, maka kita cukup buat Unit Test saja
     *
     * Membuat Test
     * ● Untuk membuat Integration Test, kita bisa lakukan manual, atau kita bisa gunakan file artisan
     * ● Jika kita ingin membuat Unit Test, kita bisa gunakan perintah :
     *
     * php artisan make:test NamaTest --unit
     *
     * ● Secara otomatis akan masuk ke folder tests/Unit
     *
     * Menjalankan Test
     * ● Untuk menjalankan test, kita bisa gunakan PHPUnit seperti biasanya
     * ● Atau jika ingin menjalankan semua test, bisa menggunakan file artisan dengan perintah : php artisan test
     */

    public function test_example()
    {
        $this->assertTrue(true);
    }

}
