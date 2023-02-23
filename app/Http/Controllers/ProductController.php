<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Imageproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index', [
            'products' => Product::with(['category'])->latest()->filter(request(['search']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create', [
            'kategoris' => Category::where('tabel_id', '3')->get()
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
            'name' => 'required|max:200',
            'slug' => 'required|unique:products',
            'category_id' => 'required',
            'price' => 'required|max:10',
            'desc' => 'nullable|max:200',
            'image' => 'nullable|image|file|max:1024'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('product-image');

            Product::create($validatedData);

            $query = Product::where('slug', $validatedData['slug'])->first();

            $dataGambar = [
                'product_id' => $query->id,
                'image' => $validatedData['image'],
            ];

            Imageproduct::create($dataGambar);
            return redirect('/formulir/products')->with('success', 'Data berhasil ditambahkan');
        }

        Product::create($validatedData);

        return redirect('/formulir/products')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', [
            'product' => $product,
            'images' => Imageproduct::with(['product'])->latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'prod' => $product,
            'kategoris' => Category::where('tabel_id', '3')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'price' => 'required|max:10',
            'desc' => 'nullable|max:200'
        ];

        if ($request->slug != $product->slug) {
            $rules['slug'] = 'required|unique:products';
        }

        $validatedData = $request->validate($rules);

        Product::where('id', $product->id)
            ->update($validatedData);
        return redirect('/formulir/products')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $query = Imageproduct::where('product_id', $product->id)->get(); //cari gambar

        if ($query) {
            foreach ($query as $quer) {
                Storage::delete($quer->image);
                Imageproduct::destroy($quer->id);
            }
        }

        Product::destroy($product->id);
        return redirect('/formulir/products')->with('success', 'Data berhasil dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
