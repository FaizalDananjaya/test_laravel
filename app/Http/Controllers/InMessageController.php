<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Inmessage;
use App\Models\Outmessage;
use App\Models\Notification;
use Illuminate\Http\Request;

class InMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.message.index', [
            'messages' => Inmessage::with(['customer'])->orderBy('status', 'asc')->latest()->filter(request(['search']))->paginate(6)->withQueryString(),
            'messageses' => Outmessage::with(['category', 'customer', 'employee'])->latest()->filter(request(['search']))->paginate(6)->withQueryString()
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
    public function store(Request $pesan)
    {
        $validatedData = $pesan->validate([
            'name' => 'required|max:30',
            'about' => 'nullable|max:20',
            'email' => 'required|email:dns',
            'body' => 'required|max:200',
            'title' => 'nullable'
        ]);

        $query = Customer::where(
            'email',
            $validatedData['email'],
        )->first();

        if ($query) {
            $dataPesan = [
                'customer_id' => $query->id,
                'title' => $validatedData['title'],
                'about' => $validatedData['about'],
                'body' => $validatedData['body'],
            ];

            Inmessage::create($dataPesan);

            $dataNotif = [
                'title' => 'Pesan baru diterima',
                'body' => 'Pengguna dengan email ' . $validatedData['email'] . ' baru saja mengirimkan pesan',
                'tabel_id' => '5' //tabel pesan masuk
            ];

            Notification::create($dataNotif);

            return redirect('/kontaks#form-contact')->with('success', 'Pesan terkirim');
        }


        Customer::create($validatedData);

        $query = Customer::where(
            'email',
            $validatedData['email'],
        )->first();

        $dataPesan = [
            'customer_id' => $query->id,
            'title' => $validatedData['title'],
            'about' => $validatedData['about'],
            'body' => $validatedData['body'],
        ];

        Inmessage::create($dataPesan);

        $dataNotif = [
            'title' => 'Pesan baru diterima',
            'body' => 'Pengguna dengan email ' . $validatedData['email'] . ' baru saja mengirimkan pesan',
            'tabel_id' => '5' //tabel pesan masuk
        ];

        Notification::create($dataNotif);

        return redirect('/kontaks#form-contact')->with('success', 'Pesan terkirim');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inmessage  $inmessage
     * @return \Illuminate\Http\Response
     */
    public function show(Inmessage $pesan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inmessage  $inmessage
     * @return \Illuminate\Http\Response
     */
    public function edit(Inmessage $pesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inmessage  $inmessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inmessage $pesan)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'about' => 'nullable',
            'body' => 'required',
            'title' => 'nullable',
            'customer_id' => 'nullable',
            'status' => 'required'
        ]);

        Inmessage::where('id', $pesan->id)
            ->update($validatedData);
        return redirect('/pesans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inmessage  $inmessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inmessage $pesan)
    {
        Inmessage::destroy($pesan->id);
        return redirect('/pesans')->with('success', 'Data berhasil dihapus');
    }

    public function tampilKontak()
    {
        return view('user.contact', [
            "link_home" => "/",
            "link_layanan" => "layanan",
            "link_galeri" => "galeri",
            "link_paket" => "pakets",
            "link_blog" => "blog",
            "link_kontak" => "kontaks",
        ]);
    }

    //ada revisi
    public function kirim(Request $kontak)
    {
        $validatedData = $kontak->validate([
            'name' => 'required|max:30',
            'about' => 'nullable|max:20',
            'email' => 'required|email:dns',
            'body' => 'required|max:200',
            'title' => 'nullable'
        ]);

        $query = Customer::where(
            'email',
            $validatedData['email'],
        )->first();

        if ($query) {
            $dataPesan = [
                'customer_id' => $query->id,
                'title' => $validatedData['title'],
                'about' => $validatedData['about'],
                'body' => $validatedData['body'],
            ];

            Inmessage::create($dataPesan);

            $dataNotif = [
                'title' => 'Pesan baru diterima',
                'body' => 'Pengguna dengan email ' . $validatedData['email'] . ' baru saja mengirimkan pesan',
                'tabel_id' => '5' //tabel pesan masuk
            ];

            Notification::create($dataNotif);

            return redirect('/#contact')->with('success', 'Appointment created');
        }


        Customer::create($validatedData);

        $query = Customer::where(
            'email',
            $validatedData['email'],
        )->first();

        $dataPesan = [
            'customer_id' => $query->id,
            'title' => $validatedData['title'],
            'about' => $validatedData['about'],
            'body' => $validatedData['body'],
        ];

        Inmessage::create($dataPesan);

        $dataNotif = [
            'title' => 'Pesan baru diterima',
            'body' => 'Pengguna dengan email ' . $validatedData['email'] . ' baru saja mengirimkan pesan',
            'tabel_id' => '5' //tabel pesan masuk
        ];

        Notification::create($dataNotif);

        return redirect('/#contact')->with('success', 'Appointment created');
    }
}
