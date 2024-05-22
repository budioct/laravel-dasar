<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{

    private HelloService $service; // Dependency Injection menggunakan construktor // interface layer service sebagai kontrak

    public function __construct(HelloService $service)
    {
        $this->service = $service;
    } // Dependency Injection

    public function hello(): string
    {
        return "Hello World!";
    }

    public function helloDependecyInjection(string $name): string
    {

        return $this->service->hello($name); //hello(string $name) // akan return "Halo $name";

    }

    public function helloRequest(Request $request): string
    {

        // $request->path() untuk mendapatkan path, misal http://example.com/foo/bar, akan
        // $request->url() untuk mendapat URL tanpa query parameter
        // $request->fullUrl() untuk mendapatkan URL dengan query parameter
        // $request->method() akan mengembalikan HTTP Method
        // $request->isMethod(method) digunakan untuk mengecek apakah request memiliki HTTP method sesuai parameter atau tidak
        // $request->header(key) digunakan untuk mendapatkan data header dengan key parameter
        // $request->header(key, default) digunakan untuk mendapatkan data header dengan key parameter, jika tidak ada maka akan mengembalikan data default nya
        // $request->bearerToken() digunakan untuk mendapatkan informasi token Bearer yang terdapat di header Authorization, dan secara otomatis menghapus prefix Bearer nya
        $requestPath = array(
            "path" => $request->path(),
            "url" => $request->url(),
            "full_url" => $request->fullUrl(),
            "method" => $request->method(),
            "is_method" => $request->isMethod('get'),
//            "headers" => $request->headers->all(),
            "header_host" => request()->header("host"),
            "header_authorization" => request()->header("Authorization"),
        );

        $json = json_encode($requestPath); // json_encode() // convert to json
        return $this->service->hello($json); // hello(string $name) // akan return "Halo $name";

        /**
         * result object php convert to json
         * Halo {
         * "path":"controller\/helloo\/request",
         * "url":"http:\/\/127.0.0.1:8000\/controller\/helloo\/request",
         * "full_url":"http:\/\/127.0.0.1:8000\/controller\/helloo\/request",
         * "method":"GET",
         * "is_method":true,
         * "header_host":"127.0.0.1:8000",
         * "header_authorization":null
         * }
         *
         * result json:
         * Halo {
         * "path": "controller/helloo/request",
         * "url": "http://127.0.0.1:8000/controller/helloo/request",
         * "full_url": "http://127.0.0.1:8000/controller/helloo/request",
         * "method": "GET",
         * "is_method": true,
         * "header_host": "127.0.0.1:8000",
         * "header_authorization": null
         * }
         */

    }
}
