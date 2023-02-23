@extends('partial.adm_master')

@section('cssneeded')

@endsection

@section('admin_pencarian')
<form class="d-none d-md-flex ms-4" action="/formulir/blogs">
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

        <div class="col-sm-4 col-xl-2">
            <a href="/formulir/blogs/create">
                <button class="btn btn-outline-info w-100" type="button">
                    Tambah Data
                </button>
            </a>
        </div>

        <!-- table -->
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Data Blog & News</h6>
                    <a href="/formulir/blogs">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white text-center">
                                <th scope="col">No</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Konten</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- diulang -->
                            @foreach ($posts as $post)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $post->title }}</td>
                                <td class="text-wrap text-center">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#gambar{{ $post->id }}"> Image{{ $post->id }}.jpg</a>
                                </td>
                                <td>{{ $post->category->name??'uncategorized' }}</td>
                                <td>{{ $post->excerpt?$post->excerpt:strip_tags($post->body) }} </td>
                                <td>
                                    <div class="d-flex flex-warp">
                                        <a class="btn btn-sm btn-success" href="/formulir/blogs/{{ $post->slug }}"><i class="fa-solid fa-eye"></i></a>|
                                        <a class="btn btn-sm btn-info" href="/formulir/blogs/{{ $post->slug }}/edit"><i class="fa-solid fa-pen-to-square"></i></a>|
                                        <form action="/formulir/blogs/{{ $post->slug }}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>

                                </td>
                            </tr>

                            <!-- Modal untuk gambar posting-->
                            <div class="modal fade" id="gambar{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="gambar{{ $post->id }}Label">{{ $post->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid modal-img" alt="">
                                            <!-- <img src="{{ asset('storage/' . $post->image) }}" class="modal-img" alt=""> -->
                                            @else
                                            <img src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" class="img-fluid modal-img" alt="">
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
                    {{ $posts->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('jsneeded')

@endsection