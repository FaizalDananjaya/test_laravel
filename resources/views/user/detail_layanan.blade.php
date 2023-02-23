@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="css/user/header_detail.css">
<link rel="stylesheet" href="css/user/layanan_style.css">
<link rel="stylesheet" href="css/partial/promo.css">

@endsection

@section('content')


<!-- hero section -->
<!-- <div class="header" style="background-image: url(../img/bgr/service.png);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Service</h1>
            </div>
        </div>
        <div class="isi">
            <span>Finding a Way to Serve you</span>
            <p><a href="/">Home</a><i class='bx bx-chevron-right'></i>Service</p>
        </div>
    </div>
</div> -->

<!-- content section -->
<div class="content">

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Our Service</span>
                <h2>The Art of Natural Beauty</h2>
            </div>
        </div>

        <div class="row">
            <div class="sisi-atas">
                <!-- diulang -->
                @foreach ($services as $service)
                <div class="box">
                    <div class="card mb-4 shadow-sm">

                        @if ( $service->image )
                        <div style="max-height:265px;overflow:hidden">
                            <img src="{{ asset('storage/' . $service->image) }}" class="img-fluid" />
                        </div>
                        @else
                        <div style="max-height:265px;overflow:hidden">
                            <img src="https://dummyimage.com/400x400/ced4da/6c757d.jpg" class="img-fluid" />
                        </div>
                        @endif
                        <div class="py-2 px-3 position-absolute" style="background-color:rgba(0,0,0,0.7)"><a class="text-light text-decoration-none">{{ $service->category->name}}</a></div>

                        <div class="card-body">
                            <div class="card-title">
                                <h3>{{ $service->name}}</h3>
                            </div>
                            <div class="card-text">
                                <p>
                                    {{ $service->desc }}
                                </p>
                                <p>
                                    Rp. {{ $service->price }}
                                </p>
                            </div>
                            <div class="text-center mt-4">
                                <a href="/galeri" class="text-decoration-none">
                                    <button type="button" class="btn button-primary">Galleries</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sampai sini -->
                @endforeach

            </div>
        </div>
    </div>
</div>

<!-- Promo -->
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
@endsection