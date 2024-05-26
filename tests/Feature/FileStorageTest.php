<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{

    /**
     * File Storage
     * ● Laravel mendukung abstraction untuk management File Storage menggunakan library Flysystem
     * ● Dengan menggunakan fitur File Storage ini, kita bisa menyimpan file ke dalam File Storage dan
     *   mengubah target dari File Storage tersebut
     * ● Misal kita bisa simpan file ke Local tempat terinstall aplikasi Laravel kita, atau bahkan kita bisa
     *   simpan file kita di Amazon S3
     * ● https://github.com/thephpleague/flysystem
     *
     * Konfigurasi File Storage
     * ● Konfigurasi file storage di Laravel terdapat di file config/filesystems.php
     * ● Kita bisa menambahkan banyak konfigurasi File Storage, dan nanti ketika kita akan menyimpan file,
     *   kita bisa menentukan File Storage mana yang akan digunakan
     *
     * FileSystem
     * ● Implementasi tiap File Storage di Laravel adalah sebuah interface bernama FileSystem
     * ● https://laravel.com/api/9.x/Illuminate/Contracts/Filesystem/Filesystem.html
     * ● Dan untuk mendapatkan storage, kita bisa gunakan Facade Storage::disk(namaFileStorage)
     * ● https://laravel.com/api/9.x/Illuminate/Support/Facades/Storage.html
     *
     * Storage Link
     * ● Secara default, File Storage disimpan di folder /storage/app
     * ● Laravel memiliki fitur bernama Storage Link, dimana kita bisa membuat link dari
     *   /storage/app/public ke /public/storage
     * ● Dengan ini maka file yang terdapat di File Storage Public bisa diakses via web
     * ● Untuk membuat link nya, kita bisa gunakan perintah :
     *   php artisan storage:link
     *
     * note: ada beberapa yaitu disk yaitu
     *  local  : ../storage/app/
     *  public : ../storage/app/public/
     *  links  : nanti akan membuat simbolic link dari directory ../storage/app/public/ di directory ../public
     */

    public function testStorage(){

        $filesystem = Storage::disk('local'); // facade interface Storage // disk() untuk get key_storeage untuk relative path storage
        $filesystem->put("file.text", "Budhi Octaviansyah, Content Here"); // put($path, $contents, $options = []): bool // untuk membuat file dengan isi content file nya

        self::assertEquals("Budhi Octaviansyah, Content Here", $filesystem->get("file.text")); // get(path) // get nama file nya
    }

    public function testSimbolicLinkStorage(){

        /**
         * $ php artisan storage:link
         * INFO  The [C:\Dev\2024\Laravel\laravel-dasar\public\storage] link has been connected to [C:\Dev\2024\Laravel\laravel-dasar\storage\app/public].
         */

        $filesystem = Storage::disk('public'); // facade interface Storage // disk() untuk get key_storeage untuk relative path storage
        $filesystem->put("file.text", "Budhi Octaviansyah, Content Here"); // put($path, $contents, $options = []): bool // untuk membuat file dengan isi content file nya

        self::assertEquals("Budhi Octaviansyah, Content Here", $filesystem->get("file.text")); // get(path) // get nama file nya
    }

}
