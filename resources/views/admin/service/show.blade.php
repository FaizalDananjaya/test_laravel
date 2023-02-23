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

        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded p-4">
                <div class="mb-4 d-flex">
                    <a href="/formulir/services" class="text-decoration-none">
                        <button class="btn-circle text-white">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </a>
                    <h4 class="my-2 mx-3">PREVIEW</h4>
                </div>

                <div class="col-sm-12 col-xl-10 justify-content-center">
                    <!-- Page content-->
                    <!-- service content-->
                    <article>
                        <!-- service header-->
                        <header class="mb-3">
                            <!-- service title-->
                            <h1 class="fw-bolder mb-1">Service : {{ $service->name }}</h1>
                            <!-- service meta content-->
                            <div class="text-muted fst-italic mb-2">Category : {{ $service->category->name }}</div>
                            <!-- service categories-->
                            <!-- Preview image figure-->
                        </header>
                        <!-- service content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-3">
                                {{  $service->desc  }}
                            </p>
                        </section>
                        <div class="gambar-all">
                            @foreach ($images as $image)
                            @if($service->id == $image->service_id)
                            <div class="gall-ser mb-3">
                                <img class="img-preview img-fluid col-sm-5 w-100" src="{{ asset('storage/' .$image->image) }}">
                                <div class="overlay">
                                    <form action="/formulir/image_services/{{ $image->id }}" method="post" class="d-inline">
                                        <input type="hidden" name="slug" value="{{ $service->slug }}">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger py-2 px-3" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>

                    </article>

                </div>

            </div>
        </div>
        <!-- <div class="col-sm-12 col-xl-4">
            <div class="bg-secondary rounded p-4">
                <button class="btn btn-outline-info w-100 my-2" type="submit">Ubah Data</button>
                <button class="btn btn-outline-danger w-100 my-2" type="submit">Hapus Data</button>
            </div>
        </div> -->
    </div>
</div>

@endsection

@section('jsneeded')

@endsection