<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.testimoni', [
            "link_home" => "/",
            "link_layanan" => "layanan",
            "link_galeri" => "galeri",
            "link_paket" => "pakets",
            "link_blog" => "blog",
            "link_kontak" => "kontaks",
            "testims" => Testimonial::where('status', '1')->orderBy('updated_at', 'desc')->take(3)->get(),
            "testims2" => Testimonial::where('status', '1')->skip(3)->take(7)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'nullable|max:30',
            'profession' => 'nullable|max:20',
            'image' => 'nullable|image|file|max:1024',
            'feedback' => 'required|max:100'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('Testimonial-image');
        }

        Testimonial::create($validatedData);

        return redirect('/testimonials')->with('success', 'Thank you for your feedback');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $dt = Carbon::now();
        $tanggal_akhir = $dt->toDateString();

        Testimonial::where('id', $testimonial->id)
            ->update([
                'status' => $request->status,
                'updated_at' => $tanggal_akhir
            ]);

        return redirect('/admin#testimonial')->with('success', 'Data berhasil ditampilkan pada halaman Testimonial');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $query1 = Testimonial::where('id', $testimonial->id)->first();

        if ($query1->image) {
            Storage::delete($query1->image);
        }

        Testimonial::destroy($testimonial->id);
        return redirect('/admin#testimonial')->with('success', 'Data berhasil dihapus');
    }
}
