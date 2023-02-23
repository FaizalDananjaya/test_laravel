@extends('partial.adm_master')

@section('cssneeded')

@endsection

@section('admin_pencarian')
<form class="d-none d-md-flex ms-4" action="/formulir/categories">
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
            <a href="/formulir/categories/create">
                <button class="btn btn-outline-info w-100" type="button">
                    Tambah Data
                </button>
            </a>
        </div>

        <!-- table -->
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Data Kategori</h6>
                    <a href="/formulir/categories">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white text-center">
                                <th scope="col">No</th>
                                <th scope="col">Kategori untuk data</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- diulang -->
                            @foreach ($kategori as $kate)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $kate->tabel->name }}</td>
                                <td>{{ $kate->name }}</td>
                                <td>{{ $kate->slug }} </td>
                                <td>
                                    <div class="d-flex flex-warp justify-content-center">
                                        <a class="btn btn-sm btn-info" href="/formulir/categories/{{ $kate->id }}/edit"><i class="fa-solid fa-pen-to-square"></i></a>|
                                        <form action="/formulir/categories/{{ $kate->id }}" method="post" class="d-inline">
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
                <div class="d-flex mt-3 justify-content-end">
                    {{ $kategori->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsneeded')

@endsection