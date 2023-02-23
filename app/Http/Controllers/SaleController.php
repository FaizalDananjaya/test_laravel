<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Dtlpack;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Detailsale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaleController extends Controller
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

        return view('admin.sales.index', [
            'sales' => Sale::with(['customer'])->latest()->orderBy('status', 'desc')->paginate(6)->withQueryString(),
            'jualan_harian' => $terjual,
            'jualan_total' => $terjual_tot,
            'untung_harian' => $untung,
            'untung_total' => $untung_tot,
            'detail_sale' => Detailsale::with(['product', 'sale'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        Sale::where('id', $sale->id)
        ->update(['status' => $request->status]);

        return redirect('/sales')->with('success', 'Pembelian berhasil disetujui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    { 
        $query = Detailsale::where('sale_id', $sale->id)->get(); //cari detail di detail

        if ($query) {
            foreach ($query as $quer) {
                Detailsale::destroy($quer->id);
            }
        }

        $query2 = Sale::where('id', $sale->id)->first();
        
        if($query2->image){
            Storage::delete($query2->image);
        }

        Sale::destroy($sale->id);
        return redirect('/sales')->with('success', 'Pembelian berhasil dihapus');
    }

    public function tampil_data()
    {
        $cart = session('cart');

        // return $cart;
        // session()->forget('cart');

        return view('user.cart', [
            "link_home" => "/",
            "link_layanan" => "layanan",
            "link_galeri" => "galeri",
            "link_paket" => "pakets",
            "link_blog" => "blog",
            "link_kontak" => "kontaks"
        ])->with('cart', $cart);
    }

    public function tambah_cart(Request $request, $id)
    {
        $cart = session("cart");

        $product = Product::where('id', $id)->first();

        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'jumlah' => $request->jumlah
        ];

        session(['cart' => $cart]);

        return redirect('/cart');
    }

    public function hapus_cart($id)
    {
        $cart = session("cart");
        unset($cart[$id]);

        session(['cart' => $cart]);

        return redirect('/cart');
    }


    public function tambah_transaksi(Request $request)
    {
        $dt = Carbon::now();
        $tanggal_transaksi = $dt->toDateString();


        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email:dns',
            'phone' => 'required|max:20',
            'address' => 'required|max:60',
            'puc' => 'required',
            'total' => 'required'
        ]);

        $query1 = Customer::create($validatedData);

        $query2 = Sale::create([
            'customer_id' => $query1->id,
            'puc' => $validatedData['puc'],
            'date' => $tanggal_transaksi,
            'total' => $validatedData['total']
        ]);

        $cart = session("cart");

        foreach ($cart as $crt => $val) {
            Detailsale::create([
                'sale_id' => $query2->id,
                'product_id' => $crt,
                'quantity' => $val['jumlah']
            ]);
        }

        session()->forget('cart');

        return redirect('/cart')->with('success', 'Thank you for believing us');
    }

    public function konfirmasi_bayar(Request $request)
    {
        $dt = Carbon::now();
        $tanggal_upload = $dt->toDateString();

        $validatedData = $request->validate([
            'image' => 'required|image|file|max:1024',
            'puc' => 'required'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('payment-image');
        }

        if ($product = Sale::where('puc', $validatedData['puc'])->first()) {
            Sale::where('id', $product->id)
                ->update([
                    'image' => $validatedData['image'],
                    'puc' => $validatedData['puc'],
                    'updated_at' => $tanggal_upload
                ]);
            return redirect('/cart')->with('success', 'Thank You, now you can pick up your goods at the store');
        } else {
            return redirect('/cart')->with('fail', 'No such Payment Unique Code');
        }
    }
}
