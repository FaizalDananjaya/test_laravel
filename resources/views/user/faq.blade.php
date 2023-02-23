@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="css/user/header_detail.css">
<link rel="stylesheet" href="css/user/faq_style.css">
<link rel="stylesheet" href="css/partial/promo.css">

@endsection

@section('content')


<!-- hero section -->
<div class="header" style="background-image: url(../img/bgr/service.png);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Help & FAQs</h1>
            </div>
        </div>
        <div class="isi">
            <span>We've got you covered</span>
            <p><a href="/">Home</a><i class='bx bx-chevron-right'></i>Help</p>
        </div>
    </div>
</div>

<!-- content section -->
<div class="content">

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Need Help</span>
                <h2>Frequently Asked Questions</h2>
            </div>
        </div>

        <div class="row">
            <div class="sisi-bawah mx-auto">
                <div class="table-harga">
                    <ul class="list-harga">
                        @foreach ($query1 as $faq1)
                        @if($faq1->id % 2 )
                        <li class="title-tanya mb-3">
                            <h5 class="tanya">
                                <p>{{ $loop->iteration }}. {{ $faq1->question }}</p>
                            </h5>
                            <p class="jawab mr-auto">{{ $faq1->answer }}</p>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>

                <div class="table-harga">
                    <ul class="list-harga">
                        @foreach ($query1 as $faq1)
                        @if($faq1->id % 2 == 0)
                        <li class="title-tanya mb-3">
                            <h5 class="tanya">
                                <p>{{ $loop->iteration }}. {{ $faq1->question }}</p>
                            </h5>
                            <p class="jawab mr-auto">{{ $faq1->answer }}</p>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="tambahTny text-center">
                <a href="/kontaks"><button type="button" class="btn">Still Have A Question?</button></a>
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