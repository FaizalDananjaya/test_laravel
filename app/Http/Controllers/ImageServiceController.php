<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Service;
use App\Models\Category;
use App\Models\Imageservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.galeri', [
            "link_home" => "/",
            "link_layanan" => "layanan",
            "link_galeri" => "galeri",
            "link_paket" => "pakets",
            "link_blog" => "blog",
            "link_kontak" => "kontaks",
            "gambar" => Imageservice::with(['service'])->get(),
            "servis" => Service::with(['category'])->distinct()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery_service.create', [
            'kategoris' => Category::where('tabel_id', '2')->get(),
            'services' => Service::with(['imageservice'])->latest()->get()
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
            'service_id' => 'required',
            'image' => 'image|file|max:1024',
        ]);

        $query = Service::where('id', $request->service_id)->first();

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('service-image');
        }

        if (!$query->image) {
            $query->update(['image' => $validatedData['image']]);
        }

        Imageservice::create($validatedData);
        return redirect('/formulir/services')->with('success', 'Gambar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imageservice  $imageservice
     * @return \Illuminate\Http\Response
     */
    public function show(Imageservice $imageservice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imageservice  $imageservice
     * @return \Illuminate\Http\Response
     */
    public function edit(Imageservice $imageservice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imageservice  $imageservice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imageservice $imageservice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imageservice  $imageservice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Imageservice $image_service)
    {
        $query = Service::where('slug', $request->slug)->first();

        if ($query->image) {
            $query->update(['image' => null]);
        }

        if ($image_service->image) {
            Storage::delete($image_service->image);
        }

        Imageservice::destroy($image_service->id);

        return redirect('/formulir/services/' . $request->slug)->with('success', 'Gambar berhasil dihapus');
    }
}
