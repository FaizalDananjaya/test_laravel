@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="css/user/paket.css">
<link rel="stylesheet" href="css/user/header_detail.css">
<link rel="stylesheet" href="css/partial/paket.css">
<link rel="stylesheet" href="css/partial/promo.css">

@endsection

@section('content')

<!-- hero section -->
<div class="header" style="background-image: url(../img/bgr/blog.png);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Package</h1>
            </div>
        </div>
        <div class="isi">
            <span>Best choice for your life</span>
            <p><a href="/">Home</a><i class='bx bx-chevron-right'></i>Package</p>
        </div>
    </div>
</div>

<!-- package section-->
<section id="paket">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Our Packages</span>
                <h2>The best deals for you</h2>
            </div>
        </div>

        <div class="paket-content">
            @foreach ($pakets as $pack)
            <div class="card">
                <!-- <img src="img/photo1.png" alt=""> -->
                <div class="card-body text-center">
                    <h5>Service Package {{ $pack->name }}</h5>
                </div>
                <div class="card-detail">
                    @foreach ( $dtlpaket as $dtl)
                    @if ($dtl->package_id == $pack->id)
                    <i class='bx bx-check-square'></i><span>{{ $dtl->service->name }}</span> <br>
                    @endif
                    @endforeach
                </div>
                <span class="mx-4 mt-3">Only for Rp. {{ $pack->price }}</span>
                <div class="text-center">
                    <a href="/books/create" class="text-decoration-none">
                        <button class="btn_paket">I want this</button>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="promo">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Service Details</span>
                <h2 class="promo-h2">Anything about service in packages</h2>
                <a href="/layanan">
                    <button type="button" class="btn btn-outline-light">Click Here</button>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsneeded')

@endsection