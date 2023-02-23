<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Employee;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.blog', [
            "link_blog" => "blog",
            "link_home" => "/",
            "link_paket" => "pakets",
            "link_galeri" => "galeri",
            "link_kontak" => "kontaks",
            "link_layanan" => "layanan",
            'categories' => Category::where('tabel_id', '1')->with(['tabel'])->get(),
            'posts' => Post::with(['employee', 'category'])->latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString()
            //mencari data kategori yang idnya sama dengan id di foreign key pada post
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.post.index', [
        //     'kategoris' => Category::all(),
        //     'kegiatans' => Post::all()
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('user.post', [
            "link_blog" => "blog",
            "link_home" => "/",
            "link_paket" => "pakets",
            "link_kontak" => "kontaks",
            "link_galeri" => "galeri",
            "link_layanan" => "layanan",
            'categories' => Category::where('tabel_id', '1')->with(['tabel'])->get(),
            'posts' => Post::with(['employee'])->distinct()->get(),
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
