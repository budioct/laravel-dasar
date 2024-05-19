<?php

/**
 * Configuration
 * ● Environment variable cocok digunakan untuk jenis konfigurasi yang memang butuh berubah-ubah
 *   nilainya, dan terintegrasi dengan baik dengan environment variable di sistem operasi
 * ● Laravel juga mendukung penulisan konfigurasi dengan menggunakan PHP Code, konfigurasi ini
 *   biasanya digunakan ketika memang dibutuhkan tidak terlalu sering berubah, dan biasanya
 *   pengaturannya hampir sama untuk tiap lokasi dijalankan aplikasi
 * ● Namun saat menggunakan fitur Laravel Configuration, kita juga tetap bisa mengakses Environment Variable
 *
 * Folder Configuration
 * ● Laravel menyimpan semua konfigurasi di folder config yang terdapat di project
 * ● Dan prefix dari konfigurasi diawali dengan file php yang terdapat di project tersebut
 *
 * Membuat File Konfigurasi
 * ● Untuk membuat file konfigurasi, kita cukup membuat file php di dalam folder config
 * ● Lalu di dalam file tersebut, kita cukup return konfigurasi dalam bentuk array
 *
 * kita juga bisa ambil value dari file .env dengan method env('key', 'default value').. syarat kita sudah set key di file .env
 * env('NAME_FIRST', "budhi")
 *
 */

return [
    "author" => [
//        "first" => "budhi",
//        "last" => "octaviansyah"
        "first" => env('NAME_FIRST', "budhi"),
        "last" => env('NAME_LAST', "octaviansyah")
    ],
    "email" => "budioct@test.com",
    "web" => "http://anakommamat.com/"
];
