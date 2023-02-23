<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dtlpack;
use App\Models\Employee;
use App\Models\Package;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appoin = Appointment::with(['service', 'customer'])->orderBy('schedule', 'asc')->filter(request(['search']))->paginate(10)->withQueryString();

        $paket = Package::with(['dtlpack'])->get();

        $events = array();
        $bookings = Schedule::all();
        foreach ($bookings as $booking) {
            $color = '#924ACE';
            $events[] = [
                'id'   => $booking->id,
                'title' => $booking->title,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'color' => $color
            ];
        }

        $events2 = array();
        foreach ($appoin as $appos) {
            $color = '#68B01A';
            $events2[] = [
                'id'   => $appos->id,
                'title' => $appos->customer->name,
                'start' => $appos->schedule,
                'color' => $color
            ];
        }

        return view('admin.schedule.index', [
            'events' => $events,
            'appos' => $events2,
            'scheds' => $appoin,
            'paket' => $paket
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $schedule)
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
    public function update(Request $request, Appointment $schedule)
    {
        $validatedData = $request->validate([
            'service_id' => 'required',
            'customer_id' => 'required',
            'schedule' => 'required',
            'fnote' => 'nullable',
            'status' => 'nullable',
        ]);

        Appointment::where('id', $schedule->id)
            ->update($validatedData);
        return redirect('/schedules')->with('success', 'Customer telah dilayani');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $schedule)
    {

        Appointment::destroy($schedule->id);

        return redirect('/schedules')->with('success', 'Appointment berhasil dihapus');
    }
}
