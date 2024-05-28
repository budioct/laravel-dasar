<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FormController extends Controller
{
    /**
     * CSRF (Cross Site Request Forgery)
     * ● CSRF merupakan salah satu security exploit yang biasanya dilakukan untuk mengirim action ke
     *   aplikasi web kita dari web orang lain alias cross domain
     * ● Hal ini sangat berbahaya, terutama misal ketika action yang dipanggil adalah action yang sangat
     *   berpotensi merugikan, misal mengirim uang misalnya
     *
     * Cara Melindungi dari CSRF
     * ● Salah satu cara untuk melindungi dari CSRF adalah mewajibkan token ketika melakukan aksi POST
     *   ke aplikasi Laravel kita
     * ● Caranya sangat sederhana, kita cukup tambahkan input berupa token yang hanya diketahui oleh
     *   aplikasi kita, dan ketika di submit menggunakan POST, token tersebut dikirim dari form HTML ke aplikasi kita
     * ● Jika token valid, maka kita tahu bahwa itu adalah aksi dari web kita sendiri, jika tidak valid, maka
     *   kita akan reject request tersebut
     *
     * CSRF Token
     * ● Untuk membuat token, Laravel sudah menyediakan function bernama csrf_token() yang digunakan
     *   untuk mendapatkan token session user
     * ● Setiap kita mengakses website di Laravel, Laravel akan menjalankan session, dan akan menyimpan CSRF token
     * ● Jika kita ingin melakukan POST request, maka kita wajib mengirimkan token tersebut di input
     * ● Laravel akan mengecek token melalui input name _token
     *
     * AJAX
     *  ● Bagaimana jika request yang dilakukan di web nya menggunakan AJAX?
     *  ● Selain menggunakan input name _token, untuk mengirim csrf token nya, kita juga bisa
     *    menggunakan header X-CSRF-TOKEN
     */

    public function form(): Response
    {

        return response()->view("form"); // view(name_file_view_on_directory_resources/views/)
    }

    public function submitForm(Request $request): Response
    {

        $name = $request->input("name"); // input(key) // get value attribute name from tag <input>

        return response()->view("hello", [
            "name" => $name,
        ]); // view(name_file, key_delegasi_variable_view);
    }
}
