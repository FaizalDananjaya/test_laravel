@extends('partial.adm_master')

@section('cssneeded')

@endsection

@section('admin_pencarian')
<form class="d-none d-md-flex ms-4" action="/formulir/services">
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
        @if(session()->has('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('fail') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="col-sm-4 col-xl-2">
            <a href="/formulir/services/create">
                <button class="btn btn-outline-info w-100" type="button">
                    Tambah Data
                </button>
            </a>
        </div>

        <div class="col-sm-4 col-xl-2">
            <a href="/formulir/image_services/create">
                <button class="btn btn-outline-info w-100" type="button">
                    Tambah Gambar
                </button>
            </a>
        </div>

        <div class="col-sm-4 col-xl-2">
            <a href="/formulir/packages/create">
                <button class="btn btn-outline-info w-100" type="button">
                    Tambah Paket
                </button>
            </a>
        </div>

        <!-- table -->
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Data Layanan</h6>
                    <a href="/formulir/services">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- diulang -->
                            @foreach ($services as $service)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $service->name }}</td>
                                <td>Rp. {{ $service->price }},-</td>
                                <td>{{ $service->category->name??'uncategorized' }}</td>
                                <td>{{ $service->desc }} </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-success" href="/formulir/services/{{ $service->slug }}"><i class="fa-solid fa-eye"></i></a>
                                    <!-- data-bs-toggle="modal" data-bs-target="#preview{{ $service->id }}"-->
                                </td>
                                <td>
                                    <div class="d-flex flex-warp  justify-content-center">
                                        <a class="btn btn-sm btn-info" href="/formulir/services/{{ $service->slug }}/edit"><i class="fa-solid fa-pen-to-square"></i></a>|
                                        <form action="/formulir/services/{{ $service->slug }}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                            <!-- sampai sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Data Paket</h6>
                    <a href="/formulir/services">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Detail Paket</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- diulang -->
                            @foreach ($pakets as $pak)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $pak->name }}</td>
                                <td>Rp. {{ $pak->price }},-</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#detail{{ $pak->id }}"><i class="fa-solid fa-eye"></i></a>
                                    <!--  "-->
                                </td>
                                <td>
                                    <div class="d-flex flex-warp  justify-content-center">
                                        <form action="/formulir/packages/{{ $pak->id }}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal untuk isi pesan -->
                            <div class="modal fade" id="detail{{ $pak->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detail{{ $pak->id }}Label">{{ $pak->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <article class="text-start">
                                                <header class="mb-4">
                                                    <h6 class="fw-bolder mb-1">Detail Paket</h6>
                                                </header>
                                                <!-- Post content-->
                                                <section class="mb-3">
                                                    <p class="fs-6 mb-2">
                                                    @foreach ($details as $dets)
                                                    @if ($dets->package_id == $pak->id)
                                                    Layanan {{ $loop->iteration }} : {{ $dets->service->name }} <br>
                                                    @endif
                                                    @endforeach
                                                    </p>

                                                </section>
                                            </article>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                    {{ $services->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('jsneeded')

<script>

</script>
@endsection