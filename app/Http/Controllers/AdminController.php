<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Todolist;
use App\Models\Inmessage;
use App\Models\Detailsale;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = date('Y-m-d');
        $quantity = Detailsale::where('created_at', 'LIKE', "%$now%")->get();

        $terjual = 0;
        foreach ($quantity as $qty) {
            $terjual += $qty->quantity;
        }

        $quantity_tot = Detailsale::all();

        $terjual_tot = 0;
        foreach ($quantity_tot as $qty) {
            $terjual_tot += $qty->quantity;
        }

        $revenue = Sale::where('date', 'LIKE', "%$now%")->get();

        $untung = 0;
        foreach ($revenue as $rvn) {
            $untung += $rvn->total;
        }

        $revenue_tot = Sale::all();

        $untung_tot = 0;
        foreach ($revenue_tot as $rvn) {
            $untung_tot += $rvn->total;
        }
        
        return view('admin.dashboard', [
            'message' => Inmessage::with(['customer'])->take(4)->latest()->get(),
            'todos' => Todolist::take(5)->latest()->get(),
            'sales' => Sale::with(['customer'])->latest()->orderBy('status', 'desc')->paginate(6)->withQueryString(),
            'jualan_harian' => $terjual,
            'jualan_total' => $terjual_tot,
            'untung_harian' => $untung,
            'untung_total' => $untung_tot,
            'detail_sale' => Detailsale::with(['product', 'sale'])->get(),
            'testims' => Testimonial::take(20)->latest()->get()
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
