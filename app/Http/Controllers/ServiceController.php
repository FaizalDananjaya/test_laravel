<?php

namespace App\Http\Controllers;

use App\Models\Dtlpack;
use App\Models\Service;
use App\Models\Category;
use App\Models\Appointment;
use App\Models\Imageservice;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.service.index', [
            'services' => Service::with(['category'])->latest()->filter(request(['search']))->paginate(10)->withQueryString(),
            'pakets' => Package::with([])->get(),
            'details' => Dtlpack::with(['package', 'service'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create', [
            'kategoris' => Category::where('tabel_id', '2')->latest()->get()
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
            'slug' => 'required|unique:services',
            'category_id' => 'required',
            'price' => 'required|max:10',
            'desc' => 'nullable|max:200',
            'image' => 'nullable|image|file|max:1024'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('service-image');

            Service::create($validatedData);

            $query = Service::where('slug', $validatedData['slug'])->first();

            $dataGambar = [
                'service_id' => $query->id,
                'image' => $validatedData['image'],
            ];

            Imageservice::create($dataGambar);
            return redirect('/formulir/services')->with('success', 'Data berhasil ditambahkan');
        }

        Service::create($validatedData);

        return redirect('/formulir/services')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('admin.service.show', [
            'service' => $service,
            'images' => Imageservice::with(['service'])->latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.service.edit', [
            'serv' => $service,
            'kategoris' => Category::where('tabel_id', '2')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $rules = [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'price' => 'required|max:10',
            'desc' => 'nullable|max:200'
        ];

        if ($request->slug != $service->slug) {
            $rules['slug'] = 'required|unique:services';
        }

        $validatedData = $request->validate($rules);

        Service::where('id', $service->id)
            ->update($validatedData);
        return redirect('/formulir/services')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $query = Imageservice::where('service_id', $service->id)->get(); //cari gambar
        $query2 = Appointment::where('service_id', $service->id)->where('package', 0)->first(); //cari bookingan
        $query3 = Dtlpack::where('service_id', $service->id)->get(); //cari detail paket

        if ($query2) {
            return redirect('/formulir/services')->with('fail', 'Data gagal dihapus karena masih ada Appointment dari customer dengan layanan ini');
        }

        if ($query) {
            foreach ($query as $quer) {
                Storage::delete($quer->image);
                Imageservice::destroy($quer->id);
            }
        }

        if ($query3) {
            foreach ($query3 as $quer) {
                Dtlpack::destroy($quer->id);
            }
        }

        Service::destroy($service->id);
        return redirect('/formulir/services')->with('success', 'Data berhasil dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Service::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
