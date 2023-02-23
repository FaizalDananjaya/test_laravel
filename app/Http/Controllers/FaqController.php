<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Services\SlugService;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.faq.index', [
            'faqs' => Faq::with(['category'])->latest()->filter(request(['search']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create', [
            'categories' => Category::where('tabel_id', '4')->get()
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
            'category_id' => 'required',
            'question' => 'required|max:200',
            'slug' => 'required|unique:faqs',
            'answer' => 'required'
        ]);

        Faq::create($validatedData);
        return redirect('/formulir/faqs')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', [
            'faqs' => $faq,
            'categories' => Category::where('tabel_id', '4')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'question' => 'required|max:200',
            'answer' => 'required'
        ]);

        if ($request->slug != $faq->slug) {
            $rules['slug'] = 'required|unique:faqs';
        }

        Faq::where('id', $faq->id)
            ->update($validatedData);
        return redirect('/formulir/faqs')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        Faq::destroy($faq->id);
        return redirect('/formulir/faqs')->with('success', 'Data berhasil dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Faq::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function tampil_data()
    {
        return view('user.faq', [
            "link_home" => "/",
            "link_layanan" => "layanan",
            "link_galeri" => "galeri",
            "link_paket" => "pakets",
            "link_blog" => "blog",
            "link_kontak" => "kontaks",
            "query1" => Faq::all()
        ]);
    }
}
