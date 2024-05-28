<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * Redirect
     * ● Sebelumnya kita sudah bahas tentang redirect di materi Route, sekarang kita bahas lebih detail
     *   tentang redirect
     * ● Redirect itu sendiri di Laravel direpresentasikan dalam response
     *   Illuminate\Http\RedirectResponse
     * ● Untuk membuat object redirect, kita bisa menggunakan helper function redirect(to)
     */

    public function redirectTo(): string {

        return "Redirect To, Hello Guys";

    }

    public function redirectFrom(): RedirectResponse{

        return redirect("/redirect/to"); // redirect() // method static redirect

        /**
         * result:
         * From
         *  Request URL: http://localhost:8000/redirect/from
         *  Request Method: GET
         *  Status Code: 302 Found
         *  emote Address: 127.0.0.1:8000
         *
         * To
         *  Request URL: http://localhost:8000/redirect/to
         *  Request Method: GET
         *  Status Code: 200 Found
         *  emote Address: 127.0.0.1:8000
         */

    }

    /**
     * Redirect to Named Routes
     * ● Sebelumnya kita sudah tahu bahwa kita bisa menambahkan name di routes
     * ● Laravel juga bisa melakukan redirect ke routes berdasarkan namanya, salah satu keuntungannya
     *   adalah kita bisa menambahkan parameter tanpa harus manual membuat path nya
     * ● Kita bisa menggunakan method route(name, params) di RedirectResponse
     */

    public function redirectName(): RedirectResponse {

        return redirect()
            ->route("redirect-hello", [
               "name" => "budhi"
            ]); // route(name, params) // name di routes redirect ke routes berdasarkan namanya.. nantinya akan,
        // from http://localhost:8000/redirect/name  to http://localhost:8000/redirect/name/budhi

    }

    public function redirectHello(string $name): string {

        return "$name";

    }

    /**
     * Redirect to Controller Action
     * ● Selain menggunakan Named Routes, kita juga bisa melakukan redirect ke Controller Action
     * ● Secara otomatis nanti Laravel akan mencari path yang sesuai dengan Controller Action tersebut
     * ● Kita bisa menggunakan method action(controller, params) di RedirectResponse
     */

    public function redirectAction(): RedirectResponse {

        return redirect()
            ->action(
                [RedirectController::class, "redirectHello"],
                ["name" => "budhi"]
            ); // action(controller, params) // redirect ke Controller Action, otomatis nanti Laravel akan mencari path yang sesuai dengan Controller Action tersebut
        // from http://localhost:8000/redirect/action  to: http://localhost:8000/redirect/name/budhi

    }

    /**
     * Redirect to External Domain
     * ● Secara default, redirect hanya dilakukan ke domain yang sama dengan lokasi domain aplikasi web Laravel nya
     * ● Jika kita ingin melakukan redirect ke domain lain, kita bisa menggunakan method away(url) di RedirectResponse
     */

    public function redirectAway(): RedirectResponse {

        return redirect()
            ->away("https://www.goal.com/id"); // away(url) // redirect ke luar app laravel

    }

}
