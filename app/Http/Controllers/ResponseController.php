<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    /**
     * Response
     * ● Sebelumnya kita sudah tahu di Route dan Controller, kita bisa mengembalikan data berupa string
     *   dan view
     * ● Laravel memiliki class Illuminate\Http\Response, yang bisa digunakan untuk representasi dari
     *   HTTP Response
     * ● Dengan class Response ini, kita bisa mengubah HTTP Response seperti Body, Header, Cookie, dan
     *   lain-lain
     * ● Untuk membuat object response, kita bisa menggunakan function helper response(content, status, headers)
     */

    public function response(Request $request): Response {

        return response("hello response"); // response($content = '', $status = 200, array $headers = []) // akan kembalikan object Response
    }

    /**
     * HTTP Response Header
     * ● Saat kita membuat Response, kita bisa ubah status dan juga response header
     * ● Kita bisa menggunakan function response(content, status, headers)
     * ● Atau bisa menggunakan method withHeaders(arrayHeaders) dan header(key, value)
     */

    public function header(Request $request): Response{

        $body = [
            "firstName" => "budhi",
            "lastName" => "octaviansyah",
        ];

        return response(json_encode($body), 200)
            ->header("Content-Type", "application/json")
            ->withHeaders([
                "Author" => "budioct",
                "App" => "Belajar Laravel"
            ]);
    }

    /**
     * Response Type
     * ● Sebelumnya kita sudah melakukan response JSON secara manual, sebenarnya Response sudah
     *   memiliki banyak sekali helper method untuk beberapa jenis response type
     * ● Untuk menampilkan view, kita bisa menggunakan method view(name, data, status, headers)
     * ● Untuk menampilkan JSON, kita bisa menggunakan method json(array, status, headers)
     * ● Untuk menampilkan file, kita bisa menggunakan file(pathToFile, headers)
     * ● Untuk menampilkan file download, kita bisa menggunakan method download(pathToFile, name,
     *   headers)
     */

    // response View dan Json
    public function responseView(Request $request):Response {

        return response()
            ->view("hello", ["name" => "budhi"]);

    }

    public function responseJson(Request $request): JsonResponse{

        $body = [
            "firstName" => "budhi",
            "lastName" => "oct"
        ];

        return response()->json($body);

    }

    public function responseFile(Request $request): BinaryFileResponse{

        return response()
            ->file(storage_path("app/public/pictures/lfc.png"));

    }

    public function responseDwonload(Request $request): BinaryFileResponse{

        return response()
            ->download(storage_path("app/public/pictures/lfc.png"), "lfc.png");

    }


}
