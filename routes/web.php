<?php

use App\Models\Product;
use App\Models\Service;
use App\Models\Employee;
use App\Models\Imageservice;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\InMessageController;
use App\Http\Controllers\PostAdminController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\OutMessageController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ImageProductController;
use App\Http\Controllers\ImageServiceController;
use App\Http\Controllers\NotificationController;

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

Route::get('/layanan', function () {
    return view('user.layanan', [
        "link_home" => "/",
        "link_layanan" => "layanan",
        "link_galeri" => "galeri",
        "link_paket" => "pakets",
        "link_blog" => "blog",
        "link_kontak" => "kontaks",
        "services" => Service::with(['category'])->get(),
        "images" => Imageservice::with(['service'])->get()
    ]);
});

Route::get('/shop', function () {
    return view('user.shop', [
        "link_home" => "/",
        "link_layanan" => "layanan",
        "link_galeri" => "galeri",
        "link_paket" => "pakets",
        "link_blog" => "blog",
        "link_kontak" => "kontaks",
        "produks" => Product::with(['category'])->paginate(12)
    ]);
});

Route::get('/career', function () {
    return view('user.pegawai', [
        "link_home" => "/",
        "link_layanan" => "layanan",
        "link_galeri" => "galeri",
        "link_paket" => "pakets",
        "link_blog" => "blog",
        "link_kontak" => "kontaks",
        "employees" => Employee::with(['category'])->get()
    ]);
});

Route::get('/layanan_detail', function () {
    return view('user.detail_layanan', [
        "link_home" => "/",
        "link_layanan" => "layanan",
        "link_galeri" => "galeri",
        "link_paket" => "pakets",
        "link_blog" => "blog",
        "link_kontak" => "kontaks",
        "services" => Service::with(['category'])->get(),
    ]);
});

Route::get('/', HomeController::class);

Route::post('/cart/tambah/{id}', [SaleController::class, 'tambah_cart']);
Route::post('/cart/transaksi', [SaleController::class, 'tambah_transaksi']);
Route::post('/cart/hapus/{id}', [SaleController::class, 'hapus_cart']);
Route::post('/cart/konfirmasi', [SaleController::class, 'konfirmasi_bayar']);
Route::get('/cart', [SaleController::class, 'tampil_data']);

Route::get('/help', [FaqController::class, 'tampil_data']);

Route::resource('/testimonials', TestimonyController::class);

Route::get('/galeri', [ImageServiceController::class, 'index']);

Route::post('/kontaks', [InMessageController::class, 'kirim']);

Route::get('/kontaks', [InMessageController::class, 'tampilkontak']);

Route::get('/pakets', [PackageController::class, 'tampil_paket']);

Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::resource('/blog', PostController::class);

Route::resource('/books', BookingController::class);

// bagian admin
Route::resource('/admin', AdminController::class)->middleware('auth');

Route::resource('/todos', ToDoController::class)->middleware('auth');

Route::get('/signIn', [SignInController::class, 'index'])->name('login')->middleware('guest');
Route::post('/signIn', [SignInController::class, 'ceklogin']);
Route::post('/logOut', [SignInController::class, 'logout']);

Route::get('/signUp', [SignUpController::class, 'index'])->middleware('guest');
Route::post('/signUp', [SignUpController::class, 'store']);

Route::get('/formulir/blogs/checkSlug', [PostAdminController::class, 'checkSlug'])->middleware('auth');
Route::resource('/formulir/blogs', PostAdminController::class)->middleware('auth');

Route::get('/formulir/categories/checkSlug', [CategoryController::class, 'checkSlug'])->middleware('auth');
Route::resource('/formulir/categories', CategoryController::class)->middleware('auth');

Route::get('/formulir/services/checkSlug', [ServiceController::class, 'checkSlug'])->middleware('auth');
Route::resource('/formulir/services', ServiceController::class)->middleware('auth');
Route::resource('/formulir/image_services', ImageServiceController::class)->middleware('auth');

Route::resource('/formulir/packages', PackageController::class)->middleware('auth');

Route::get('/formulir/products/checkSlug', [ProductController::class, 'checkSlug'])->middleware('auth');
Route::resource('/formulir/products', ProductController::class)->middleware('auth');
Route::resource('/formulir/image_products', ImageProductController::class)->middleware('auth');

Route::get('/formulir/faqs/checkSlug', [FaqController::class, 'checkSlug'])->middleware('auth');
Route::resource('/formulir/faqs', FaqController::class)->middleware('auth');

Route::resource('/formulir/employees', EmployeeController::class)->middleware('auth');

Route::resource('/schedules', AppointmentController::class)->middleware('auth');

Route::post('/schedusers', [ScheduleController::class, 'store'])->name('schedusers.store')->middleware('auth');
Route::post('/schedusers/update/{id}', [ScheduleController::class, 'update'])->name('schedusers.update')->middleware('auth');
Route::post('/schedusers/destroy/{id}', [ScheduleController::class, 'destroy'])->name('schedusers.destroy')->middleware('auth');

Route::resource('/notifs', NotificationController::class)->middleware('auth');

Route::resource('/sales', SaleController::class)->middleware('auth');

Route::get('/pesans/jadwal/{appos}', [OutMessageController::class, 'jawabjadwal'])->middleware('auth');
Route::get('/pesans/one/{kirimpesan}', [OutMessageController::class, 'edit'])->middleware('auth');
Route::get('/pesans/one', [OutMessageController::class, 'kirimsatu'])->middleware('auth');
Route::get('/pesans/all', [OutMessageController::class, 'kirimall'])->middleware('auth');
Route::resource('/kirimpesans', OutMessageController::class)->middleware('auth');
Route::resource('/pesans', InMessageController::class)->middleware('auth');
