<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Routing
 * ● Routing adalah proses menerima HTTP Request dan menjalankan kode sesuai dengan URL yang
 *   diminta. Routing biasanya tergantung dari HTTP Method dan URL
 * ● Salah satu Service Provider yang paling penting di Laravel adakah RouteServiceProvider.
 * ● RouteServiceProvider bertanggung jawab untuk melakukan load data routing dari folder routes.
 *   Jika kita hapus Service Provider ini, secara otomatis proses routing tidak akan berjalan
 * ● RouteServiceProvider secara default akan me-load data routing dari folder routes
 *
 * Basic Routing
 * ● Salah satu contoh routing yang paling sederhana adalah menggunakan path dan juga closure
 *   function sebagai handler nya
 * ● Kita bisa menggunakan Facades Route, lalu menggunakan function sesuai dengan HTTP Methodnya, misal:
 * ○ Route::get($uri, $callback);
 * ○ Route::post($uri, $callback);
 * ○ Route::put($uri, $callback);
 * ○ Route::patch($uri, $callback);
 * ○ Route::delete($uri, $callback);
 * ○ Route::options($uri, $callback);
 *
 * Redirect
 * ● Router juga bisa digunakan untuk melakukan redirect dari satu halaman ke halaman lain
 * ● Kita bisa menggunakan function Route::redirect(from, to)
 *
 * Melihat Semua Routing
 * ● Kadang kita ada kebutuhan melihat semua Routing yang ada di aplikasi Laravel kita
 * ● Untuk melihatnya, kita bisa memanfaatkan file artisan dengan perintah :
 *   php artisan route:list
 *
 * Fallback Route
 * ● Apa yang terjadi jika kita melakukan request ke halaman yang tidak ada di aplikasi Laravel kita?
 *   Secara otomatis akan mengembalikan error 404
 * ● Kadang-kadang kita ingin mengubah tampilan halaman error ketika halaman yang diakses tidak ada
 * ● Pada kasus seperti ini, kita bisa membuat fallback route, yaitu callback yang akan dieksekusi ketika
 *   tidak ada route yang cocok dengan halaman yang diakses
 * ● Kita bisa menggunakan function Route::fallback(closure)
 *
 * Rendering View
 * ● Setelah kita membuat View, selanjutnya untuk me-render (menampilkan) View tersebut di dalam
 *   Router, kita bisa menggunakan function Route::view(uri, template, array) atau menggunakan
 *   view(template, array) di dalam closure function Route
 * ● Dimana template adalah nama template, tanpa menggunakan blade.php, dan array berisikan data
 *   variable yang ingin kita gunakan
 *
 * Nested View Directory
 * ● View juga bisa disimpan di dalam directory lagi di dalam directory views
 * ● Hal ini baik ketika kita sudah banyak membuat views, dan ingin melakukan management file views
 * ● Namun ketika kita ingin mengambil views nya, kita perlu ganti menjadi titik, tidak menggunakan / (slash)
 * ● Misal jika kita buat views di folder admin/profile.blade.php, maka untuk mengaksesnya kita
 *   gunakan admin.profile
 */

// http method get
Route::get('/', function () {
    return view('welcome');
});

Route::get("/test", function () {
    return "<b>ini adalah halaman test</b>";
});

Route::get("/ommamat", function () {
    return "<h1>HALAMAN ANAK OM MAMAT </h1>";
});

// http redirect halaman
Route::redirect("/test-redirect", "ommamat");

// response fallback route (jika tidak path route maka anak di tampilkan halaman ini)
Route::fallback(function () {
    return "<h1>404 Halaman Tidak Ada<br> by Anak Om Mamat</h1>";
});

// rendereing / tampilkan view
Route::view("/hello", "hello", ["name" => "Anak Om Mamat"]); // view(path, name_view, parsing_data_ke_view) // // method static facade untuk handle path, view, dan data

Route::get("/hello-again", function () {
    return view("hello", ["name" => "Anak Om Mamat"]); // view(name_view, parsing_data_ke_view) // method static yang digunakan untuk view
}); // get(path, method_closure) // method static facade untuk handle path, view, dan data

// Nested View Directory
// Misal jika kita buat views di folder admin/profile.blade.php, maka untuk mengaksesnya kita gunakan admin.profile
Route::view("/world", "hello.world", ["name" => "Anak Om Mamat"]); // akses folder view dengan: directory.nama_file

Route::get("/world-again", function () {
    return view("hello.world", ["name" => "Anak Om Mamat"]);
});

// Route Parameter
Route::get("/products/{id}", function ($productId) {
    return "Products : " . $productId;
})->name("product.detail"); // name(key_page) // Named Route penganti route path atau alias dari route path

Route::get("/products/{product}/items/{item}", function ($productId, $itemsId) {
    return "Products : " . $productId . ", Items : " . $itemsId;
})->name("product.item.detail"); // name(key_page) // Named Route penganti route path atau alias dari route path

// Route Parameter set regex
Route::get("/categories/{id}", function (string $categoryId) {
    return "Categories : " . $categoryId;
})
    ->where("id", "[0-9]+") // where({id}, regex) // menambah regular expression untuk route parameter / path variable parameter.. jika salah masukan route parameter akan di return Route::fallback()
    ->name("category.detail"); // name(key_page) // Named Route penganti route path atau alias dari route path

// Optional Route Parameter.. tambahkan "?" seperti {key_parameter?} // wajib set default value di param method closure
Route::get("users/{id?}", function (string $userid = "404") {
    return "Users : " . $userid;
})->name("user.detail"); // name(key_page) // Named Route penganti route path atau alias dari route path


// Routing Conflict.. selalu memproritaskan Route biasa baru RouteParameter
Route::get('/conflict/budhi', function () {
    return "Conflict Budhi Octaviansyah";
});

Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});

// menggunakan Named Route
Route::get("/produk/{id}", function ($id) {
    $link = route("product.detail", [
        "id" => $id,
    ]); // route(named_route, binding_param_closure dari RouteParameter
    return "link : " . $link;
});

Route::get("/product-redirect/{id}", function ($id) {
    return redirect()->route("product.detail", [
        "id" => $id,
    ]);
});


// route yang di teruskan ke Controller
Route::get("/controller/hello", [App\Http\Controllers\HelloController::class, "hello"]); // get(path, [reference_object_controller, method])
Route::get("/controller/hello/{name}", [App\Http\Controllers\HelloController::class, "helloDependecyInjection"]);

// request get web client
Route::get("/controller/helloo/request", [App\Http\Controllers\HelloController::class, "helloRequest"]);

// request post web client
Route::get("/input/hello", [App\Http\Controllers\InputController::class, "hello"]); // request query param
Route::post("/input/hello", [App\Http\Controllers\InputController::class, "hello"]); // form request
Route::withoutMiddleware([App\Http\Middleware\VerifyCsrfToken::class])->group(function () {
    Route::post("/input/hello/first", [App\Http\Controllers\InputController::class, "helloFirstName"]);
    Route::post("/input/hello/input", [App\Http\Controllers\InputController::class, "helloCollectInputAll"]);
    Route::post("/input/hello/array", [App\Http\Controllers\InputController::class, "arrayImput"]);

    Route::post("/inpute/type", [App\Http\Controllers\InputController::class, "inputType"]);
    Route::post("/input/filter/only", [App\Http\Controllers\InputController::class, "filterOnly"]);
    Route::post("/input/filter/except", [App\Http\Controllers\InputController::class, "filterExcept"]);
    Route::post("/input/filter/merge", [App\Http\Controllers\InputController::class, "filterMerge"]);

    Route::post("/file/upload", [App\Http\Controllers\FileController::class, "upload"]);

    Route::get("/response/hello", [App\Http\Controllers\ResponseController::class, "response"]);
    Route::get("/response/header", [App\Http\Controllers\ResponseController::class, "header"]);
    Route::get("/response/type/view", [App\Http\Controllers\ResponseController::class, "responseView"]);
    Route::get("/response/type/json", [App\Http\Controllers\ResponseController::class, "responseJson"]);
    Route::get("/response/type/file", [App\Http\Controllers\ResponseController::class, "responseFile"]);
    Route::get("/response/type/dwonload", [App\Http\Controllers\ResponseController::class, "responseDwonload"]);

    Route::get("/cookie/set", [App\Http\Controllers\CookieController::class, "createCookie"]);
    Route::get("/cookie/get", [App\Http\Controllers\CookieController::class, "getCookie"]);
    Route::get("/cookie/clear", [App\Http\Controllers\CookieController::class, "clearCookie"]);

    Route::get("/redirect/from", [App\Http\Controllers\RedirectController::class, "redirectFrom"]);
    Route::get("/redirect/to", [App\Http\Controllers\RedirectController::class, "redirectTo"]);
    Route::get("/redirect/name", [App\Http\Controllers\RedirectController::class, "redirectName"]);
    Route::get("/redirect/name/{name}", [App\Http\Controllers\RedirectController::class, "redirectHello"])
        ->name("redirect-hello");
    Route::get("/redirect/action", [App\Http\Controllers\RedirectController::class, "redirectAction"]);
    Route::get("/redirect/away", [App\Http\Controllers\RedirectController::class, "redirectAway"]);

    // middleware
    //Route::get("/middleware/api", function (){
    //    return "OK";
    //})->middleware("contoh"); // set dengan alias
        //->middleware(\App\Http\Middleware\ContohMiddleware::class); // set dengan class middleware
    Route::get("/middleware/group", function (){
        return "GROUP";
    })->middleware(["sb"]); // set dari group
    Route::get("/middleware/api", function (){
        return "OK";
    })->middleware("contoh:SB,401"); // contoh:SB,401 // name_alias_middleware:$key,$status // mengirim parameter ke middleware yang di buat

}); // tanpa pengecekan middleware csrf_token laravel

Route::post("/file/upload", [App\Http\Controllers\FileController::class, "upload"])
    ->middleware(App\Http\Middleware\VerifyCsrfToken::class); // Exclude Middleware, non-aktifkan middleware

