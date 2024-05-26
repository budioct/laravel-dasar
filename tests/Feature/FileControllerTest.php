<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{

    /**
     * jika error:
     * Error yang Anda hadapi muncul karena PHP tidak dapat menemukan fungsi imagecreatetruecolor().
     * Fungsi ini adalah bagian dari ekstensi GD (GD Library) di PHP, yang digunakan untuk manipulasi gambar.
     *
     * Berikut adalah langkah-langkah untuk menyelesaikan masalah ini:
     *
     * 1. Pastikan Ekstensi GD Terinstal
     * Periksa apakah ekstensi GD terinstal dan diaktifkan pada PHP. Anda dapat melakukannya dengan memeriksa file php.ini.
     *
     * Di Windows:
     * Buka file php.ini.
     * Cari baris yang mengandung ;extension=gd.
     * Hilangkan tanda titik koma (;) di depan extension=gd, sehingga menjadi
     * extension=gd
     *
     * Restart server web Anda (misalnya, Apache atau Nginx).
     *
     * 2. Periksa Instalasi Ekstensi GD
     * Setelah mengaktifkan ekstensi GD, pastikan untuk memeriksa apakah ekstensi tersebut sudah terinstal dengan benar. Anda dapat membuat file PHP dengan isi berikut untuk memeriksa informasi PHP:
     *
     * 3. Jalankan Kembali Unit Test
     * Setelah memastikan ekstensi GD aktif, jalankan kembali unit test Anda untuk memastikan bahwa error telah teratasi.
     */

    public function testUpload(){

        $picture = UploadedFile::fake()->image('budhioct.png'); // akan membuat file fake untuk unit test

        $this->post('/file/upload', [
            'picture' => $picture
        ])->assertSeeText("OK budhioct.png");

        /**
         * melihat hasil update
         *
         * http://127.0.0.1:8000/storage/pictures/lfc.png
         */

    }

}
