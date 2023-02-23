@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="{{asset('css/user/header_detail.css')}}" />
<link rel="stylesheet" href="{{asset('css/user/post_style.css')}}" />
<link rel="stylesheet" href="{{asset('css/partial/promo.css')}}" />
<link rel="stylesheet" href="{{asset('css/partial/footer.css')}}" />

@endsection

@section('content')

<!-- content -->
<div class="content">

    <!-- Page content-->
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                        <!-- Post meta content  ->toDateString()   ->format('m/d/Y')-->
                        <div class="text-muted fst-italic mb-2">Posted on {{ $post->created_at->format('d M Y') }} by {{ $post->employee->nama }}</div>
                        <!-- Post categories-->
                        <a class="badge bg-secondary text-decoration-none link-light" href="/blog?category={{ $post->category->slug }}">{{ $post->category->name  }}</a>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4">
                        <!-- @if ($post->foto)
                        <div style="max-height:400; overflow:hidden">
                            <img class="img-fluid rounded" src="{{ asset('storage/' .$post->foto) }}" alt="..." />
                        </div>
                        @else
                        <img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." />
                        @endif -->

                        @if ($post->image)
                        <div class="post-gambar">
                            <img class="img-fluid rounded" src="{{ asset('storage/' . $post->image) }}" />
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
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4 d-none">
                    <!-- tak hidden-->
                    <div class="card-header">Search</div>
                    <form>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..." name="search" />
                                <button class="btn btn-primary" type="submit" onclick="findWord()">Go!</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header text-start"><span>Categories</span></div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @foreach ($categories as $category)
                            <li>
                                <a class="text-decoration-none text-dark" href="/blog?category={{ $category->slug }}">{{ $category->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header text-start"><span>Author</span></div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @foreach ($posts as $usr)
                            <li>
                                @if ($usr->id == $usr->employee->id)
                                <a class="text-decoration-none text-dark" href="/blog?author={{ $usr->employee->nama }}">{{ $usr->employee->nama }}</a>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Side widget-->
                <!-- <div class="card mb-4">
                    <div class="card-header">Side Widget</div>
                    <div class="card-body">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis dolorum at harum inventore dolore! Eaque facere molestias at, quos veritatis excepturi ea? Eveniet impedit obcaecati suscipit, eligendi facilis provident autem.</div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- promo -->
<div class="promo">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Get 20% Off </span>
                <h2 class="promo-h2">For Your First Visit</h2>
                <a href="/books/create" class="text-decoration">
                    <button type="button" class="btn btn-outline-light">Book Now</button>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsneeded')
<script>
    function findString() {
        text = "cum";
        window.find(text)
    }
</script>
@endsection