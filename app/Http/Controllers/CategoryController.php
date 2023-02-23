<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tabel;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Faq;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index', [
            'kategori' => Category::with(['tabel'])->latest()->filter(request(['search']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create', [
            'tabels' => Tabel::whereNotNull('name')->with('category')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tabel_id' => 'required',
            'name' => 'required|max:200',
            'slug' => 'required|unique:categories',
            'data' => 'nullable'
        ]);

        Category::create($validatedData);
        return redirect('/formulir/categories')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('user.blog', [
            "link_blog" => "blog",
            "link_home" => "/home",
            "link_paket" => "paket",
            "link_galeri" => "galeri",
            "link_kontak" => "kontak",
            "link_layanan" => "layanan",
            'title' => $category->name,
            'posts' => $category->posts,
            'category' => $category->name,
            'categories' => Category::with(['tabel'])->get()

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category,
            'tabels' => Tabel::whereNotNull('name')->with('category')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $validatedData = $request->validate([
            'tabel_id' => 'required',
            'name' => 'required|max:200',
            'slug' => 'required|unique:posts'
        ]);

        if ($request->slug != $category->slug) {
            $rules['slug'] = 'required|unique:categories';
        }

        Category::where('id', $category->id)
            ->update($validatedData);
        return redirect('/formulir/categories')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (
            Post::where('category_id', '=', $category->id)->count() > 0 ||
            Faq::where('category_id', '=', $category->id)->count() > 0 ||
            Service::where('category_id', '=', $category->id)->count() > 0 ||
            Product::where('category_id', '=', $category->id)->count() > 0
        ) {
            return redirect('/formulir/categories')->with('fail', 'Data gagal dihapus karena masih terdapat data lain yang terhubung dengan kategori');
        }

        Category::destroy($category->id);

        return redirect('/formulir/categories')->with('success', 'Data berhasil dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
