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

    public function inputType(Request $request): string
    {

        $name = $request->input("name"); // hasil input langsung di konversi pada type yang di inginkan
        $married = $request->boolean("married");
        $birthDate = $request->date("birthDate", "Y-m-d");

        // note: untuk response birth_data akan terlihat seperti string
        return json_encode([
            "name" => $name,
            "married" => $married,
            "birth_data" => $birthDate->format("Y-m-d")
        ]);

    }

    public function filterOnly(Request $request): string
    {
        $name = $request->only(["name.first", "name.last"]); // only([]) // yang di sebutkan di dalam parameter akan di ambil datanya.. yang tidak di sebutkan tidak akan di ambil
        return json_encode($name);
    }

    public function filterExcept(Request $request): string
    {
        $user = $request->except(["admin"]); // except([]) // yang di sebutkan di dalam paramater tidak akan di ambil datanya.. yang tidak di sebutkan akan di ambil datanya
        return json_encode($user);
    }

    public function filterMerge(Request $request): string{

        $request->merge(["admin" => false]); // merge([]) // yang di sebutkan di dalam parameter akan ada default value, jika tidak di kirimkan atau di kirimkan key:value nya dalam request
        $user = $request->input();

        return json_encode($user);

    }

}
