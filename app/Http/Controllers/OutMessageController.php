<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Tabel;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Inmessage;
use App\Models\Outmessage;
use App\Models\Notification;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Database\Factories\CustomerFactory;

class OutMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.message.index', [
            'messages' => Outmessage::with(['category', 'customer', 'employee'])->latest()->filter(request(['search']))->get()
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
    public function store(Request $kirimpesan)
    {
        $customer_id = $kirimpesan->email;

        if ($kirimpesan->email) {
            $customer = DB::table('customers')
                ->where('email', '=', $customer_id)
                ->first();
            if ($customer) {
                $customer_id =  $customer->id;
                $email_baru = $customer->email;

                $validatedData = $kirimpesan->validate([
                    'title' => 'required|max:200',
                    'category_id' => 'required|max:20',
                    'customer_id' => 'nullable',
                    'employee_id' => 'required',
                    'body' => 'required|max:200',
                    'email' => 'nullable|email:dns'
                ]);

                $validatedData['customer_id'] = $customer_id;
                $validatedData['email'] = $email_baru;

                // $dataNotif = [
                //     'title' => 'Pesan terkirim',
                //     'body' => 'Pesan dengan judul ' . $validatedData['title'] . ' untuk tujuan ' . $validatedData['email'] . ' berhasil terkirim',
                //     'tabel_id' => '6'
                // ];

                // Notification::create($dataNotif);

                Outmessage::create($validatedData);
                return redirect('/pesans')->with('success', 'Pesan berhasil dikirimkan');
            }

            $validatedData = $kirimpesan->validate([
                'title' => 'required|max:200',
                'category_id' => 'required|max:20',
                'employee_id' => 'required',
                'body' => 'required|max:200',
                'email' => 'required|email:dns'
            ]);

            Outmessage::create($validatedData);
            return redirect('/pesans')->with('success', 'Pesan berhasil dikirimkan');
        }

        $validatedData = $kirimpesan->validate([
            'title' => 'required|max:200',
            'category_id' => 'required|max:20',
            'customer_id' => 'nullable',
            'email' => 'nullable|email:dns',
            'employee_id' => 'required',
            'body' => 'required|max:200'
        ]);

        $validatedData['email'] = "Semua Subscriber";

        Outmessage::create($validatedData);
        return redirect('/pesans')->with('success', 'Pesan berhasil dikirimkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outmessage  $outmessage
     * @return \Illuminate\Http\Response
     */
    public function show(Outmessage $kirimpesan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outmessage  $outmessage
     * @return \Illuminate\Http\Response
     */
    public function edit(Inmessage $kirimpesan)
    {
        return view('admin.message.send_one', [
            'title' => "Menjawab: " . $kirimpesan->body,
            'email' => $kirimpesan->customer->email,
            'kategoris' => Category::with(['tabel'])->where('tabel_id', '6')->get(),
            'kat_rep' => '12'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outmessage  $outmessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outmessage $kirimpesan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outmessage  $outmessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outmessage $kirimpesan)
    {
        Outmessage::destroy($kirimpesan->id);
        return redirect('/pesans')->with('success', 'Data berhasil dihapus');
    }

    public function kirimall()
    {
        return view('admin.message.send_all', [
            'kategoris' => Category::with(['tabel'])->where('tabel_id', '6')->get()
        ]);
    }

    public function kirimsatu()
    {
        return view('admin.message.send_one', [
            'title' => "",
            'email' => "",
            'kategoris' => Category::with(['tabel'])->where('tabel_id', '6')->get(),
            'kat_rep' => '12'
        ]);
    }

    public function jawabjadwal(Appointment $appos)
    {
        return view('admin.message.send_one', [
            'title' => "Appointment",
            'email' => $appos->customer->email,
            'kategoris' => Category::with(['tabel'])->where('tabel_id', '6')->get(),
            'kat_rep' => '12'
        ]);
    }
}
