<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Customer;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
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
        $first = DB::table('services')
            ->select('name', 'id');

        $query = DB::table('packages')
            ->select('name', 'id')
            ->union($first)
            ->get();

        return view('user.book', [
            "link_home" => "/",
            "link_layanan" => "layanan",
            "link_galeri" => "galeri",
            "link_paket" => "pakets",
            "link_blog" => "blog",
            "link_kontak" => "kontaks",
            'layanan' => $query
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
            'service_id' => 'required|max:20',
            'email' => 'required|email:dns',
            'phone' => 'nullable|max:20',
            'schedule' => 'required|unique:appointments',
            'fnote' => 'nullable',
            'package' => 'nullable'
        ]);

        $service = Service::where(
            'name',
            $validatedData['service_id']
        )->first();

        $paket = Package::where(
            'name',
            $validatedData['service_id']
        )->first();

        if ($service) {
            $validatedData['package'] = 0;
            $validatedData['service_id'] = $service->id;
        } else {
            $validatedData['package'] = "1";
            $validatedData['service_id'] = $paket->id;
        }

        $query = Customer::where(
            'name',
            $validatedData['name']
        )->orWhere(
            'email',
            $validatedData['email']
        )->first();

        if ($query) {

            $dataAppointment = [
                'customer_id' => $query->id,
                'service_id' => $validatedData['service_id'],
                'schedule' => $validatedData['schedule'],
                'fnote' => $validatedData['fnote'],
                'package' => $validatedData['package']
            ];

            Appointment::create($dataAppointment);

            $dataNotif = [
                'title' => 'Appointment baru',
                'body' => 'Pelanggan dengan nama ' . $validatedData['name'] . ' telah membuat janji temu di ' . $validatedData['schedule'],
                'tabel_id' => '7' //tabel appointment
            ];

            Notification::create($dataNotif);

            return redirect('/books/create#success')->with('success', 'Appointment created');
        }


        Customer::create($validatedData);

        $query = Customer::where(
            'name',
            $validatedData['name']
        )->orWhere(
            'email',
            $validatedData['email']
        )->first();

        $dataAppointment = [
            'customer_id' => $query->id,
            'service_id' => $validatedData['service_id'],
            'schedule' => $validatedData['schedule'],
            'fnote' => $validatedData['fnote'],
            'package' => $validatedData['package']
        ];

        Appointment::create($dataAppointment);

        $dataNotif = [
            'title' => 'Appointment baru',
            'body' => 'Pelanggan dengan nama ' . $validatedData['name'] . ' telah membuat janji temu di ' . $validatedData['schedule'],
            'tabel_id' => '7' //tabel appointment
        ];

        Notification::create($dataNotif);

        return redirect('/books/create#success')->with('success', 'Appointment created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
