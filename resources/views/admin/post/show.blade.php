@extends('partial.adm_master')

@section('cssneeded')

@endsection

@section('admin_content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded p-4">
                <div class="mb-4 d-flex">
                    <a href="/formulir/blogs" class="text-decoration-none">
                        <button class="btn-circle text-white">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </a>
                    <h4 class="my-2 mx-3">PREVIEW</h4>
                </div>

                <div class="col-sm-12 col-xl-8 justify-content-center">
                    <!-- Page content-->
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on {{ $post->created_at->format('d M Y') }} by {{ $post->employee->nama }}</div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light">{{ $post->category->name  }}</a>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4">
                            @if ($post->image)
                            <div class="show-gambar">
                                <img class="img-fluid rounded" src="{{ asset('storage/' .$post->image) }}" alt="..." />
                            </div>
                            @else
                            <img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." />
                            @endif

                        </figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4">
                                {!! $post->body !!}
                            </p>
                        </section>
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