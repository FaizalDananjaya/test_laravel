@extends('partial.adm_master')

@section('cssneeded')

@endsection

@section('admin_pencarian')
<form class="d-none d-md-flex ms-4" action="/pesans">
    <input class="form-control bg-dark border-0" name="search" type="search" placeholder="Search" autocomplete="off" value="{{ request('search') }}">
</form>
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

        <div class="col-sm-5 col-xl-3">
            <a href="/pesans/all">
                <button class="btn btn-outline-info w-100" type="button">
                    Kirim Pesan (Semua Subscriber)
                </button>
            </a>
        </div>

        <div class="col-sm-5 col-xl-3">
            <a href="/pesans/one">
                <button class="btn btn-outline-info w-100" type="button">
                    Kirim Pesan (Satu Tujuan)
                </button>
            </a>
        </div>

        <!-- table -->
        <div id="inbox" class="col-sm-12 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Riwayat Pesan Masuk</h6>
                    <a href="/pesans">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white text-center">
                                <th scope="col">No</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Pengirim</th>
                                <th scope="col">Tentang</th>
                                <th scope="col">Isi Pesan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- diulang -->
                            @foreach ($messages as $mess)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $mess->scopeWaktu() }}</td>
                                <td>{{ $mess->customer->name }}</td>
                                <td>{{ $mess->about?? "Undefined" }} </td>
                                <td class="text-wrap">
                                    <div class="text-center">
                                        @if ($mess->status == 0)
                                        <a href="" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#pesan{{ $mess->id }}">
                                            <i class="fa-solid fa-eye"> </i>
                                        </a>
                                        @else
                                        <a href="" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#pesan{{ $mess->id }}">
                                            <i class="fa-solid fa-eye"> </i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-warp justify-content-center">
                                        <a class="btn btn-sm btn-info" href="/pesans/one/{{ $mess->id }}"><i class="fa-solid fa-reply"></i></a>|
                                        <form action="/pesans/{{ $mess->id }}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal untuk isi pesan -->
                            <div class="modal fade" id="pesan{{ $mess->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pesan{{ $mess->id }}Label">{{ $mess->customer->name?? "Anonymous" }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <article class="text-start">
                                                <!-- Post header-->
                                                <header class="mb-4">
                                                    <!-- Post title-->
                                                    <h6 class="fw-bolder mb-1">{{ $mess->title }}</h6>
                                                    <!-- Post meta content-->
                                                    <div class="text-muted fst-italic mb-2">Sent by {{ $mess->customer->email }} on {{ $mess->created_at->format('d M Y') }} </div>
                                                    <!-- Post categories-->
                                                    <a class="badge bg-secondary text-decoration-none link-light">{{ $mess->about?? "Undefined" }}</a>
                                                </header>
                                                <!-- Post content-->
                                                <section class="mb-3">
                                                    <p class="fs-6 mb-2">
                                                        {{ $mess->body }}
                                                    </p>
                                                </section>
                                            </article>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="text-end">
                                                @if ($mess->status == 0)
                                                <form action="/pesans/{{ $mess->id }}" method="post">
                                                    @method('put')
                                                    @csrf
                                                    <input type="hidden" value="{{ $mess->id }}" name="id">
                                                    <input type="hidden" value="{{ $mess->title }}" name="title">
                                                    <input type="hidden" value="{{ $mess->about }}" name="about">
                                                    <input type="hidden" value="{{ $mess->body }}" name="body">
                                                    <input type="hidden" value="{{ $mess->customer_id }}" name="customer_id">
                                                    <input type="hidden" value="1" name="status">
                                                    <button type="submit" class="btn btn-outline-warning">Mark as read</button>
                                                </form>
                                                @else
                                                <button class="btn btn-outline-success" data-bs-dismiss="modal">Close</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- sampai sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="sent" class="col-sm-12 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Riwayat Pesan Terkirim</h6>
                    <a href="/pesans">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white text-center">
                                <th scope="col">No</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Tujuan</th>
                                <th scope="col">Pengirim</th>
                                <th scope="col">Isi Pesan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- diulang -->
                            @foreach ($messageses as $messe)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $messe->scopeWaktu() }}</td>
                                <td>{{ $messe->title }}</td>
                                <td>{{ $messe->category->name }}</td>
                                <td>{{ $messe->customer->email??$messe->email }}</td>
                                <td>{{ $messe->employee->nama }}</td>
                                <td class="text-wrap">
                                    <div class="text-center">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#outpesan{{ $messe->id }}" class="btn btn-sm btn-success">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-warp justify-content-center">
                                        <form action="/kirimpesans/{{ $messe->id }}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal untuk isi pesan -->
                            <div class="modal fade" id="outpesan{{ $messe->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pesan{{ $messe->id }}Label">To : {{ $messe->customer->name?? "Anonymous" }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <article class="text-start">
                                                <!-- Post header-->
                                                <header class="mb-4">
                                                    <!-- Post title-->
                                                    <h6 class="fw-bolder mb-1">{{ $messe->title }}</h6>
                                                    <!-- Post meta content-->
                                                    <div class="text-muted fst-italic mb-2">Sent by {{ $messe->employee->nama }} on {{ $messe->created_at->format('d M Y') }}</div>
                                                    <!-- Post categories-->
                                                    <a class="badge bg-secondary text-decoration-none link-light">{{ $messe->about?? "Undefined" }}</a>
                                                </header>
                                                <!-- Post content-->
                                                <section class="mb-3">
                                                    <p class="fs-6 mb-2">
                                                        {{ $messe->body }}
                                                    </p>
                                                </section>
                                            </article>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-outline-success" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- sampai sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3 justify-content-end">
            {{ $messageses->links() }}
        </div>
    </div>
</div>

@endsection

@section('jsneeded')

@endsection