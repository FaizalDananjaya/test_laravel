@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="/css/user/header_detail.css">
<link rel="stylesheet" href="/css/user/blog_style.css">

@endsection

@section('content')

<!-- hero section -->
<!-- <div class="header" style="background-image: url(../img/bgr/blog.png);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Blog</h1>
            </div>
        </div>
        <div class="isi">
            <span>Only the best topics written</span>
            <p><a href="home">Home</a><i class='bx bx-chevron-right'></i>Blog</p>
        </div>
    </div>
</div> -->

<div class="content" id="content">
    <div class="container">

        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Our Blog</span>
                <h2>Latest News and Events</h2>
            </div>
        </div>
        <!--  -->

        @if($posts->count())

        <div class="row">
            <div class="sisi-kiri">
                @foreach ($posts as $post)
                <div class="box">
                    <div class="card mb-4 shadow-sm">
                        @if ($post->image)
                        <div class="post-gambar">
                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" />
                        </div>
                        @else
                        <img src="/img/galeri/photo1.png" class="img-fluid" />
                        @endif
                        <div class="py-2 px-3 position-absolute" style="background-color:rgba(0,0,0,0.7)"><a class="text-light text-decoration-none" href="/blog?category={{ $post->category->slug }}">{{ $post->category->name}}</a></div>

                        <div class="card-body">
                            <div class="keterangan">
                                <a class="pembuat" href="/blog?author={{ $post->employee->nama }}">{{ $post->employee->nama }}</a>
                                <a class="tanggalbuat">{{ $post->created_at->diffForHumans() }}</a>
                            </div>
                            <div class="card-title">
                                <h3>{{ $post->title }}</h3>
                            </div>
                            <div class="card-text">
                                <p>
                                    {{ $post->excerpt?$post->excerpt:strip_tags($post->body) }}
                                </p>
                            </div>
                            <a href="/posts/{{ $post->slug }}" class="btn btn-outline-primary rounded-0 float-end">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="col-md-3 sisi-kanan">
                <form action="/blog">
                    <div class="cari">
                        @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if (request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                        @endif
                        <input type="text" name="search" placeholder="Search.." autocomplete="off" value="{{ request('search') }}">
                        <span><button type="submit"><i class='bx bx-search'></i></button></span>
                    </div>
                </form>
                <div class="tags">
                    <h3>RIGHT NOW</h3>
                    @if (request('category'))
                    <h5>{{ ucfirst( request('category') ) }}</h5>
                    @else
                    <h5>All Categories</h5>
                    @endif
                </div>
                <div class="kategori">
                    <h3>CATEGORIES</h3>
                    <a href="/blog">All Categories<span></span> </a>
                    @foreach ($categories as $category)
                    <a href="/blog?category={{ $category->slug }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        @else
        <div class="row">
            <div class="sisi-kiri">
                <div class="cari2 col-12 text-center mx-5">
                    <h3>No post found</h3>
                </div>
            </div>

            <div class="col-md-3 sisi-kanan">
                <div class="cari">
                    <input type="text" placeholder="Search">
                    <span><button><i class='bx bx-search'></i></button></span>
                </div>
            </div>
        </div>

        @endif

        {{ $posts->links() }}

    </div>
</div>



@endsection

@section('jsneeded')

@endsection