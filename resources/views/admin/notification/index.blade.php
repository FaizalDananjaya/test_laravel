@extends('partial.adm_master')

@section('cssneeded')

@endsection

@section('admin_pencarian')
<form class="d-none d-md-flex ms-4" action="/notifs">
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

        <!-- table -->
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Detail Pemberitahuan</h6>
                    <a href="/notifs">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white text-center">
                                <th scope="col">No</th>
                                <th scope="col">Data</th>
                                <th scope="col">Judul pemberitahuan</th>
                                <th scope="col">Isi pemberitahuan</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- diulang -->
                            @foreach ($notifis as $notif)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    @if ($notif->tabel->name) {{ $notif->tabel->name }}
                                    @elseif ($notif->tabel_id == 7) Appointment
                                    @else Message
                                    @endif
                                </td>
                                <td>{{ $notif->title }}</td>
                                <td>{{ $notif->body }}</td>
                                <td>{{ $notif->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="d-flex flex-warp justify-content-center">
                                        @if ($notif->status == 0)
                                        <form action="/notifs/{{ $notif->id }}" method="post" class="d-inline">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" name="tabel_id" value="{{ $notif->tabel_id }}">
                                            <input type="hidden" name="title" value="{{ $notif->title }}">
                                            <input type="hidden" name="body" value="{{ $notif->body }}">
                                            <input type="hidden" name="status" value="1">
                                            <input type="hidden" name="id" value="{{ $notif->id }}">
                                            <input type="hidden" name="link" value="{{ $notif->tabel->link }}">
                                            <button class="btn btn-sm btn-warning" type="submit"><i class="fa-solid fa-eye"></i></button>
                                        </form>
                                        @else
                                        <a class="btn btn-sm btn-success" href="/{{ $notif->tabel->link }}"><i class="fa-solid fa-eye"></i></a>
                                        @endif
                                        |
                                        <form action="/notifs/{{ $notif->id }}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal untuk detail notification-->
                            <div class="modal fade" id="gambar{{ $notif->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="gambar{{ $notif->id }}Label">{{ $notif->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($notif->title)
                                            <input value="{{ $notif->title }}">
                                            @else
                                            <input value="woe">
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
                    {{ $notifis->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('jsneeded')

@endsection