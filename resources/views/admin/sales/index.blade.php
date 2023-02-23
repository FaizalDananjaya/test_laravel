@extends('partial.adm_master')

@section('cssneeded')

@endsection

@section('admin_content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- summary -->
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today Sale</p>
                    <h6 class="mb-0">{{ $jualan_harian??0 }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Sale</p>
                    <h6 class="mb-0">{{ $jualan_total }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today Revenue</p>
                    <h6 class="mb-0">Rp. {{ $untung_harian }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Revenue</p>
                    <h6 class="mb-0">Rp. {{ $untung_total }}</h6>
                </div>
            </div>
        </div>

        <!-- table -->
        <div class="col-sm-6 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Data Penjualan Barang</h6>
                    <a href="">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white text-center">
                                <th scope="col">No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- diulang -->
                            @foreach ($sales as $sale)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $sale->scopeWaktu() }}</td>
                                <td><a href="" data-bs-toggle="modal" data-bs-target="#detail{{ $sale->id }}">{{ $sale->puc }}</a></td>
                                <td><a href="" data-bs-toggle="modal" data-bs-target="#customer{{ $sale->id }}">{{ $sale->customer->name }}</a></td>
                                <td>Rp. {{ $sale->total }}</td>
                                @if ($sale->image && $sale->status != "Approved")
                                <td>Pending</td>
                                @elseif ($sale->status == "Approved")
                                <td>Approved</td>
                                @else
                                <td>-</td>
                                @endif
                                @if ($sale->image)
                                <td><a href="" data-bs-toggle="modal" data-bs-target="#gambar{{ $sale->id }}">Pembayaran{{$sale->id}}</a></td>
                                @else
                                <td>-</td>
                                @endif
                                <td class="mx-auto d-flex flex-warp justify-content-center">
                                    <form action="/sales/{{ $sale->id }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="status" value="Approved">
                                        <button type="submit" class="btn btn-sm btn-success">Acc</button>
                                    </form>
                                    |
                                    <form action="/sales/{{ $sale->id }}" method="post" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal untuk detail customer-->
                            <div class="modal fade" id="detail{{ $sale->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detail{{ $sale->id }}Label">Detail Pembelian</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($detail_sale as $detail)
                                            @if ($detail->sale_id == $sale->id)
                                            <div class="d-flex w-100 justify-content-between">
                                                <div> Barang : {{ $detail->product->name }} ( {{ $detail->quantity }} ) </div>
                                                <div> Subtotal : {{ $detail->product->price * $detail->quantity }}</div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal untuk detail customer-->
                            <div class="modal fade" id="customer{{ $sale->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="customer{{ $sale->id }}Label">Detail Pelanggan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <p class="fs-6 mb-2">
                                            <p> Nama : {{ $sale->customer->name }} </p>
                                            <p> Email : {{ $sale->customer->email }} </p>
                                            <p> Phone : {{ $sale->customer->phone }} </p>
                                            <p> Alamat : {{ $sale->customer->address }} </p>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal untuk bukti bayar-->
                            <div class="modal fade" id="gambar{{ $sale->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="gambar{{ $sale->id }}Label">{{ $sale->customer->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($sale->image)
                                            <img src="{{ asset('storage/' . $sale->image) }}" class="img-fluid modal-img" alt="">
                                            @else
                                            <img src="https://dummyimage.com/400x400/ced4da/6c757d.jpg" class="img-fluid modal-img" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- sampai sini -->
                        </tbody>
                    </table>
                </div>
                <div class="d-flex mt-3 justify-content-end">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsneeded')

@endsection