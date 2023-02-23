@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="css/user/header_detail.css">
<link rel="stylesheet" href="css/user/contact_style.css">

@endsection

@section('content')

<!-- hero section -->
<div class="header" style="background-image: url(../img/bgr/contact.png);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Contact Us</h1>
            </div>
        </div>
        <div class="isi">
            <span>We value our clients, and it shows in every interaction</span>
            <p><a href="/">Home</a><i class='bx bx-chevron-right'></i>Contact</p>
        </div>
    </div>
</div>

<!-- content section -->
<div class="content">

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Find Us</span>
                <h2>Have Any Question?</h2>
            </div>
        </div>

        <div class="iframe-container">
            <iframe width="80%" height="350" style="border: 1px solid black" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?q=0.5269700380698236%2C%20101.42641340881474&zoom=18&key=AIzaSyBoNwGWJAQx-eszGEgj_DxIVBYD5wFGMrg"></iframe>
        </div>

        <div class="isi">

            <div id="form-contact" class="row justify-content-center">
                <div class="col-md-6 sisi-kiri">
                    <p>Send A Message</p>
                    <span>If you want to ask anything just fill in the form below and send us.</span>
                    <form class="row g-3" method="POST" action="/pesans">
                        @csrf
                        <input type="hidden" name="title" value="Pesan via halaman kontak">
                        <div class="col-md-6">
                            <label for="inputName4" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" placeholder="Jessica" autocomplete="off">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}" placeholder="Jessica@example.com" autocomplete="off">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputTitle" class="form-label">What's this about?</label>
                            <input type="text" class="form-control px-2" placeholder="e.g. Voucher / Testimony / Appointment etc." name="about" id="about" value="{{old('about')}}" autocomplete="off">
                        </div>
                        <div class="col-12">
                            <label for="inputMessage2" class="form-label">Your Message...</label>
                            <textarea type="text" class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="5" style="resize: none" placeholder="Write anything you want to ask . .">{{old('body')}}</textarea>
                            @error('body')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>

                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </form>
                </div>

                <div class="col-md-4">
                    <div class="kotak-content">
                        <p class="title-kotak">Contact Details</p>
                        <p>Reach, Call, Relax</p>
                        <div class="sisi-kanan"><i class='bx bxs-map'></i>
                            <p>Jl. Tamtama Ruko 29 Labuh Baru Timur, Pekanbaru</p>
                        </div>
                        <div class="sisi-kanan"><i class='bx bxs-phone'></i>
                            <p><span> 0825 828 78813</span> <br>beautykirei44@gmail.com</p>
                        </div>
                        <div class="sisi-kanan"><i class='bx bxs-calendar'></i>
                            <p><span>Mon - Sun:</span> 10.00 AM - 19.00 PM <br><span>Holiday:</span> Closed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection