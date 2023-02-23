<?php

namespace App\Http\Controllers;

use App\Models\Dtlpack;
use App\Models\Package;
use App\Models\Service;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create', [
            'services' => Service::all()
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
            'name' => 'required|max:30',
            'price' => 'required',
            'service_id' => 'required'
        ]);

        Package::create($validatedData);

        $query = Package::where('name', $validatedData['name'])->first();

        if ($query) {
            foreach ($validatedData['service_id'] as $servis) {
                $detailPaket = [
                    'package_id' => $query->id,
                    'service_id' => $servis
                ];

                Dtlpack::create($detailPaket);
            }
        }

        return redirect('/formulir/services')->with('success', 'Paket berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $query3 = Dtlpack::where('package_id', $package->id)->get(); //cari detail paket

        if ($query3) {
            foreach ($query3 as $quer) {
                Dtlpack::destroy($quer->id);
            }
        }
        
        Package::destroy($package->id);
        return redirect('/formulir/services')->with('success', 'Paket berhasil dihapus');
    }

    public function tampil_paket()
    {
        return view('user.paket', [
            "link_home" => "/",
            "link_layanan" => "layanan",
            "link_galeri" => "galeri",
            "link_paket" => "pakets",
            "link_blog" => "blog",
            "link_kontak" => "kontaks",
            'pakets' => Package::with(['dtlpack'])->latest()->get(),
            'dtlpaket' => Dtlpack::with(['service', 'package'])->latest()->get()
        ]);
    }
}
