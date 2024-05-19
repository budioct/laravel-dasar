<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependencyInjectionTest extends TestCase
{

    /**
     * Dependency Injection
     * ● Di dalam pengembangan perangkat lunak, ada konsep yang namanya Dependency Injection
     * ● Dependency Injection adalah teknik dimana sebuah object menerima object lain yang dibutuhka
     *   atau istilahnya dependencies
     * ● Saat kita membuat object, sering sekali kita membuat object yang butuh object lain
     * ● https://en.wikipedia.org/wiki/Dependency_injection
     *
     * Foo dan Bar
     * ● Dari class Foo dan Bar kita tahu bahwa Bar membutuhkan Foo, artinya Bar depends-on Foo, atau
     *   Foo adalah dependency untuk Bar
     * ● Dependency Injection berarti kita perlu memasukkan object Foo ke dalam Bar, sehingga Bar bisa
     *   menggunakan object Foo
     * ● Pada kode Foo dan Bar kita menggunakan Constructor untuk melakukan injection (memasukkan
     *   dependency), sebenarnya caranya tidak hanya menggunakan Constructor, bisa menggunakan
     *   Attribute atau Function, namun sangat direkomendasikan menggunakan Constructor agar bisa
     *   terlihat jelas dependencies nya dan kita tidak lupa menambahkan dependencies nya
     */

    public function testDependencyInjection(){

        $foo = new Foo();
        $bar = new Bar($foo); // set Dependecy Inject constructor (di rekomendasikan) // object bar depend from object foo
        // $bar->setFoo($foo); // set Dependecy Inject method (tidak di rekomendasikan)
        // $bar->foo = $foo; // set Dependecy Inject property (tidak di rekomendasikan)

        self::assertEquals("Foo and Bar", $bar->bar());

    }

}
