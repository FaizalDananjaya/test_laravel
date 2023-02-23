<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Imageproduct;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery_product.create', [
            'kategoris' => Category::where('tabel_id', '2')->get(),
            'products' => Product::with(['imageproduct'])->latest()->get()
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
            'product_id' => 'required',
            'image' => 'image|file|max:1024',
        ]);

        $query = Product::where('id', $request->product_id)->first();

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('product-image');
        }

        if (!$query->image){
            $query->update(['image' => $validatedData['image']]);
        }

        Imageproduct::create($validatedData);
        return redirect('/formulir/products')->with('success', 'Gambar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imageproduct  $imageproduct
     * @return \Illuminate\Http\Response
     */
    public function show(Imageproduct $imageproduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imageproduct  $imageproduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Imageproduct $imageproduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imageproduct  $imageproduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imageproduct $imageproduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imageproduct  $imageproduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Imageproduct $Image_product)
    {

        $query = Product::where('slug', $request->slug)->first();

        if ($query->image) {
            $query->update(['image' => null]);
        }

        if ($Image_product->image) {
            Storage::delete($Image_product->image);
        }

        Imageproduct::destroy($Image_product->id);

        return redirect('/formulir/products/' . $request->slug)->with('success', 'Gambar berhasil dihapus');
    }
}
