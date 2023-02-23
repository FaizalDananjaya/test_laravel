@extends('partial.adm_master')

@section('cssneeded')

@endsection

@section('admin_content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

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
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Penjualan Terbaru</h6>
                    <a href="/sales">Show All</a>
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
                                    </form>|
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- tab -->
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Messages</h6>
                    <a href="/pesans">Show All</a>
                </div>
                @foreach ($message as $mess)
                <div class="d-flex align-items-center border-bottom py-3">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">{{ $mess->customer->name??$mess->email }}</h6>
                            <small>{{ $mess->created_at->diffForHumans() }}</small>
                        </div>
                        <span>{{ Str::limit(strip_tags($mess->body), 25) }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Calender</h6>
                    <a href="/schedules">Show All</a>
                </div>
                <div id="calender"></div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">To Do List</h6>
                    <!-- <a href="">Show All</a> -->
                </div>
                <form action="/todos" method="post">
                    <div class="d-flex mb-2">
                        @csrf
                        <input class="form-control bg-dark border-0 @error('todo') is-invalid @enderror" name="todo" type="text" placeholder="Enter task" autocomplete="off">
                        <button type="submit" class="btn btn-primary ms-2">Add</button>
                        @error('todo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </form>
                @foreach ($todos as $todo)
                <div class="d-flex align-items-center border-bottom py-2">
                    <input class="form-check-input m-0" type="checkbox">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>{{ $todo->todo }}</span>
                            <form action="/todos/{{ $todo->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-sm" type="submit"><i class="fa fa-times"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        <!-- table testimoni -->
        <div class="col-sm-6 col-xl-12" id="testimonial">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Data Testimonial</h6>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white text-center">
                                <th scope="col">No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Profession</th>
                                <th scope="col">Feedback</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testims as $tess)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $tess->scopeWaktu() }}</td>
                                <td>{{ $tess->name??"Anonymous" }}</td>
                                <td>{{ $tess->profession??"Not Included" }}</td>
                                <td>{{ $tess->feedback }}</td>
                                @if ($tess->image)
                                <td><a href="" data-bs-toggle="modal" data-bs-target="#gambar{{ $tess->id }}">Image{{$tess->id}}</a></td>
                                @else
                                <td>-</td>
                                @endif
                                <td class="mx-auto d-flex flex-warp justify-content-center">
                                    <form action="/testimonials/{{ $tess->id }}" method="post">
                                        @method('put')
                                        @csrf
                                        @if ($tess->status == 0)
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-sm btn-success">Publish</button>
                                        @else
                                        <input type="hidden" name="status" value="0">
                                        <button type="submit" class="btn btn-sm btn-warning">Hide</button>
                                        @endif
                                    </form>
                                    |
                                    <form action="/testimonials/{{ $tess->id }}" method="post" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal untuk gambar testi-->
                            <div class="modal fade" id="gambar{{ $tess->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="gambar{{ $tess->id }}Label">{{ $tess->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($tess->image)
                                            <img src="{{ asset('storage/' . $tess->image) }}" class="img-fluid modal-img" alt="">
                                            @else
                                            <img src="https://dummyimage.com/400x400/ced4da/6c757d.jpg" class="img-fluid modal-img" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('jsneeded')

@endsection