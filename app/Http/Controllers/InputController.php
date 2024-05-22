<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $name = $request->input("name"); // input("key_input_web_client") // get input dari user bisa // query_param // request_body // form_request
        // $name = $request->name;
        return "Hello $name";
    }

    public function helloFirstName(Request $request): string
    {
        $firstName = $request->input('name.first'); // 'name.first' nested input [name => [first => value]] // name[first] postman_form
        return "Hello $firstName";
    }

    public function helloCollectInputAll(Request $request): string
    {
        $input = $request->input(); // Request::input() // mengambil semua input yang terdapat di HTTP Request, baik itu dari query param ataupun body
        return json_encode($input);
    }

    public function arrayImput(Request $request): string
    {

        $names = $request->input("products.*.name"); // products.*.name // artinya kita mengambil semua name yang ada di array products
        return json_encode($names);

    }

}
