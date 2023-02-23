<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Dtlpack;
use App\Models\Imageservice;
use App\Models\Package;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        return view('index', [
            "link_home" => "#hero",
            "link_layanan" => "#layanan",
            "link_galeri" => "#galeri",
            "link_paket" => "#paket",
            "link_blog" => "#blog",
            "link_kontak" => "#contact",
            "posts" => Post::take(3)->latest()->get(),
            "galeris" => Imageservice::take(8)->latest()->get(),
            'pakets' => Package::with(['dtlpack'])->latest()->get(),
            'dtlpaket' => Dtlpack::with(['service', 'package'])->latest()->get(),
            'testi' => Testimonial::take(3)->orderBy('updated_at', 'desc')->get()
        ]);
    }
}
