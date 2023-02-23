@extends('partial.adm_master')

@section('cssneeded')

@endsection

@section('admin_pencarian')
<form class="d-none d-md-flex ms-4" action="/formulir/employees">
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
            <a href="/formulir/employees/create">
                <button class="btn btn-outline-info w-100" type="button">
                    Tambah Data
                </button>
            </a>
        </div>

        <!-- table -->
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Data Karyawan</h6>
                    <a href="/formulir/employees">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- diulang -->
                            @foreach ($employees as $employee)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $employee->nama }}</td>
                                <td>{{ $employee->jk }}</td>
                                <td>{{ $employee->no_telp }} </td>
                                <td>{{ $employee->category->name??'uncategorized' }}</td>
                                <td class="text-wrap">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#gambar{{ $employee->id }}"> Image{{ $employee->id }}.jpg</a>
                                </td>
                                <td>{{ $employee->alamat }} </td>
                                <td>
                                    <div class="d-flex flex-warp justify-content-center">
                                        <a class="btn btn-sm btn-info" href="/formulir/employees/{{ $employee->id }}/edit"><i class="fa-solid fa-pen-to-square"></i></a>|
                                        <form action="/formulir/employees/{{ $employee->id }}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>

                                </td>
                            </tr>

                            <!-- Modal untuk gambar posting-->
                            <div class="modal fade" id="gambar{{ $employee->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="gambar{{ $employee->id }}Label">{{ $employee->nama }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($employee->image)
                                            <img src="{{ asset('storage/' . $employee->image) }}" class="img-fluid modal-img" alt="">
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
                    {{ $employees->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('jsneeded')

@endsection