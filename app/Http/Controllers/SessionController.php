<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Session
     * ● Seperti kita ketahui, bahwa HTTP itu stateless, artinya setiap request dilakukan secara
     *   independent, dan tidak ada hubungannya dengan request lain
     * ● Session digunakan untuk menyimpan data yang bisa digunakan antar request, dan biasanya session
     *   disimpan di persistent storage
     * ● Laravel menyediakan abstraction layer untuk kita mengelola session, sehingga kita tidak perlu
     *   menggunakan PHP session lagi
     * ● Semua konfigurasi Laravel session terdapat di file config/session.php
     *
     * Session Driver
     * ● Laravel mendukung banyak sekali session driver, yaitu tempat session itu disimpan
     * ● file, session disimpan di storage/framework/sessions
     * ● cookie, session disimpan di cookie dan di enkripsi
     * ● database, session disimpan di database
     * ● memcache / redis, session disimpan di in memory database
     * ● dynamodb, session disimpan di amazon dynamidb
     * ● array, session disimpan di in memory array
     *
     * Mengambil Session
     * ● Session direpresentasikan dalam interface Illuminate\Contracts\Session\Session
     * ● https://laravel.com/api/9.x/Illuminate/Contracts/Session/Session.html
     * ● Untuk mendapatkan object Session, ada banyak caranya
     * ● Kita bisa menggunakan method session() dari object Request
     * ● Atau bisa menggunakan helper method session()
     * ● Atau bisa menggunakan facade Session
     *
     * Menyimpan Data ke Session
     * ● Ada banyak method yang bisa kita gunakan untuk menyimpan data ke Session
     * ● put(key, value), menyimpan data dengan key dan value
     * ● push(key, value), menambah data ke array dengan key dan value
     * ● pull(key, value), mengambil data di array, dan menghapusnya
     * ● increment(key, increment), menaikkan value di session
     * ● decrement(key, decrement), menurunkan value di session
     * ● forget(key), menghapus data di session
     * ● flush(), menghapus semua data di session
     * ● invalidate(), menghapus semua data, dan membuat session baru
     *
     * note: secara default laravel menyimpan session di file. lokasi file nya  ../framework/session/file_session
     */

    public function createSession(Request $request): string
    {

        $request->session()->put("userId", "budhioct"); //  put(key, value) // menyimpan data dengan key dan value
        $request->session()->put("isMember", "true");

        return "OK";
    }

    /**
     * Mengambil Data dari Session
     * ● Ada banyak method yang bisa kita gunakan untuk mengambil data dari Session
     * ● get(key, default), untuk mengambil data dari session dengan key
     * ● all(), untuk mengambil semua data di session
     * ● has(key), untuk mengecek data di session
     * ● missing(key), untuk mengecek apakah data tidak ada di session
     */

    public function getSession(Request $request): string
    {

        $userId = $request->session()->get("userId", "budhioct"); //  get(key, value) // untuk mengambil data dari session dengan key
        $isMember = $request->session()->get("isMember", "true");

        return "User Id: ${userId}, Is Member: ${isMember}";
    }

}
