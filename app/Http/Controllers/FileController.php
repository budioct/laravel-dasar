<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{

    /**
     * File Upload
     * ● Laravel juga sudah menyediakan method file(key) di Request untuk mengambil request file upload
     * ● Tipe data File Upload direpresentasikan dalam class Illuminate\Http\UploadedFile di Laravel
     * ● https://laravel.com/api/9.x/Illuminate/Http/UploadedFile.html
     * ● File Upload di Laravel terintegrasi dengan baik dengan File Storage
     *
     * note: ada beberapa yaitu disk yaitu
     *   local  : ../storage/app/
     *   public : ../storage/app/public/
     *   links  : nanti akan membuat simbolic link dari directory ../storage/app/public/ di directory ../public
     *
     * get()
     * path() get lokasi sekarang
     * allFiles() get all file upload
     * store() simpan tetapi nama file nya random
     * storePubliclyAs() simpan di public nama bisa custom
     *
     */

    public function upload(Request $request): string {

        $picture = $request->file('picture'); // file(key) // collect file upload berdasarkan nama key yang di kirimkan dari object Request
        $picture->storePubliclyAs("pictures", $picture->getClientOriginalName(), "public"); // storePubliclyAs(generate_folder_tempat_simpan, nama_file, type_storage)

        return "OK " . $picture->getClientOriginalName(); // getClientOriginalName() // get nama asli file

        /**
         * melihat hasil update
         *
         * http://127.0.0.1:8000/storage/pictures/lfc.png
         */
    }

}
