@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="css/user/header_detail.css">
<link rel="stylesheet" href="css/user/pegawai_style.css">
<link rel="stylesheet" href="css/partial/promo.css">

@endsection

@section('content')


<!-- hero section -->
<div class="header" style="background-image: url(../img/bgr/service.png);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Career Oportunity</h1>
            </div>
        </div>
        <div class="isi">
            <span>Go with the Team</span>
            <p><a href="/">Home</a><i class='bx bx-chevron-right'></i>Career Oportunity</p>
        </div>
    </div>
</div>


<!-- content -->
<div class="content">

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">The Team</span>
                <h2>You are in good hands</h2>
            </div>
        </div>

        <div class="row">
            <div class="sisi-atas">

                @foreach ($employees as $employee)
                @if($employee->category->name != "Owner")
                <div class="box mx-auto">
                    <div class="card mb-4 border-light shadow-sm">
                        <div class="img-hover-zoom">
                            @if ($employee->image)
                            <div style="max-height:265px;overflow:hidden">
                                <img src="{{ asset('storage/' . $employee->image) }}" class="img-fluid mx-auto" />
                            </div>
                            @else
                            <div style="max-height:265px;overflow:hidden">
                                <img src="img/galeri/photo6.png" class="img-fluid" />
                            </div>
                            @endif
                        </div>

                        <div class="card-body text-center">
                            <div class="card-title">
                                <h3>{{ $employee->nama }}</h3>
                            </div>
                            <div class="card-text">
                                <p>
                                    {{ $employee->category->name??'uncategorized' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach

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
@endsection