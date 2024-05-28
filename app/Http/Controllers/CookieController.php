<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    /**
     * Cookie
     * ● Saat kita membuat HTTP Response, kadang kita perlu membuat cookie.
     * ● Cookie adalah data yang otomatis dikirim ketika kita melakukan HTTP Request juga.
     * ● Jadi kadang Cookie banyak digunakan untuk melakukan management session di aplikasi berbasis web.
     *
     * Secure Cookie
     * ● Secara default, cookie yang dibuat di Laravel akan selalu di enkripsi, dan ketika kita membaca
     *   cookie, secara otomatis akan di dekrip
     * ● Semua hal itu dilakukan otomatis oleh class App\Http\Middleware\EncryptCookies
     * ● Jika misal kita tidak ingin melakukan enkripsi pada sebuah cookie, kita bisa mengubah property
     *   EncryptCookies yang bernama $except
     *
     * Membuat Cookie
     * ● Untuk membuat cookie, kita bisa gunakan method cookie(name, value, timeou, path, domain,
     *   secure, httpOnly) di object Response
     */

    public function createCookie(Request $request): Response{

        return response("Hello Cookie")
            ->cookie("User-Id", "budhi", 1000, "/")
            ->cookie("Is-Member", 'true', 1000, "/"); // cookie($cookie) // cookie(name, value, timeou, path, domain, secure, httpOnly) // membuat cookie di laravel

        /**
         * result:
         * Set-Cookie:
         * User-Id=eyJpdiI6Ii93dWtaRUkvWStTdysvaTFXeHlyd2c9PSIsInZhbHVlIjoiQmZpU2E4Vms3cmpJWHRoZjF4c1REN0lwbENrZHAwSWlWMC9ISS9JUzc3YUkrdXcrQTFhcVQrK21HVmovMDVvWSIsIm1hYyI6ImZiYmQwZmJkNjAxOTBiNzEwZmYxZjIyZWZhZTg2ZTZiZWE1MzEyZGE5N2Y5NDU1ZGI5YTRjY2RlN2FlMDZlOTQiLCJ0YWciOiIifQ%3D%3D;
         * expires=Wed, 29 May 2024 03:44:35 GMT;
         * Max-Age=60000;
         * path=/;
         * httponly;
         * samesite=lax
         *
         * Set-Cookie:
         * Is-Member=eyJpdiI6IkhROERjdkNhUURta0labmZ2ZWpuZlE9PSIsInZhbHVlIjoicXJjczR4eEpPY3hra0NVUXhzbm93SFF3YkcxK2x2enQ2citqaFVhM1lTdmJRM0F0UzNrd2xvRGhBcjRMTldkWiIsIm1hYyI6ImE3NWRmNDhjMmJlYTJlZWIwMTA2ZTM2MTBjMDM4MDk4Yjk0MTU2NTZkZTliNGY1MTc1OGFiZTUyNGY2NmJhMzQiLCJ0YWciOiIifQ%3D%3D;
         * expires=Wed, 29 May 2024 03:44:35 GMT;
         * Max-Age=60000;
         * path=/;
         * httponly;
         * samesite=lax
         */

    }

    /**
     *  Menerima Cookie
     *  ● Setelah membuat cookie di Response, secara otomatis Cookie akan disimpan di Browser sampai
     *    timeout atau expired
     *  ● Browser akan secara otomatis mengirim cookie tersebut ke domain dan path yang sudah
     *    ditentukan ketika kita membuat cookie
     *  ● Oleh karena itu, kita bisa menangkap data cookie tersebut di Response dengan method
     *    cookie(name, default)
     *  ● Atau jika ingin mengambil semua cookies dalam array, kita bisa gunakan $request->cookies->all()
     */

    public function getCookie(Request $request): JsonResponse {

        return response()
            ->json([
                "userId" => $request->cookie("User-Id", "guest"),
                "isMember" => $request->cookie("Is-Member", "false")
            ]); // cookie(name, default) // mendapatkan cookie di laravel

    }

    /**
     * Clear Cookie
     * ● Tidak ada cara untuk menghapus cookie
     * ● Namun jika kita ingin menghapus cookie, kita bisa membuat cookie dengan nama yang sama
     *   dengan value kosong, dan waktu expired secepatnya
     * ● Di Laravel, hal ini bisa kita lakukan dengan menggunakan method withoutCookie(name)
     */

    public function clearCookie(Request $request): Response {

        return response("Clear Cookie")
            ->withCookie("User-Id")
            ->withoutCookie("Is-Member"); // withoutCookie(key_cookie) // menghapus cookie dengan nama yang sama dengan value kosong

        /**
         * result: cookie dengan key Is-Member tidak ada (tanda sudah di clear)
         * Set-Cookie:
         * Is-Member=eyJpdiI6IjJOSGxhMWd4VUtDVzYxckNvMjlnQ2c9PSIsInZhbHVlIjoid040R21LNC9HTTJjSld0REdyVkVLV2hvOU5ZWUkxMkRqZ3R1WTU2NXJJS2ErYlFRbVBMQVhxY2IwZVVoTWJmWiIsIm1hYyI6IjFjMjAzOGE3MjZkYzM0YTA1MGMzZDFmYWMwNWVlY2Y1NDg1ZjI1NzBlM2I0YmJjMTYzNmE4ZjNhMzhhMjE5OWQiLCJ0YWciOiIifQ%3D%3D;
         * expires=Thu, 30 May 2019 11:13:07 GMT;
         * Max-Age=0;
         * path=/;
         * httponly;
         * samesite=lax
         */

    }





}
