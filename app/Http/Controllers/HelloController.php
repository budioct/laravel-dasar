<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{

    private HelloService $service; // Dependency Injection menggunakan construktor // interface layer service sebagai kontrak

    public function __construct(HelloService $service){
        $this->service = $service;
    } // Dependency Injection

    public function hello(): string
    {
        return "Hello World!";
    }

    public function helloDependecyInjection(string $name): string{

        return $this->service->hello($name); //hello(string $name) // akan return "Halo $name";

    }
}
