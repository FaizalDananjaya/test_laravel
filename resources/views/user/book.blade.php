@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="/css/user/header_detail.css">
<link rel="stylesheet" href="/css/user/booking_style.css">
<link rel="stylesheet" href="/css/responsive/responsive.css">
<link rel="stylesheet" href="/css/partial/promo.css">

@endsection

@section('content')

<!-- hero section -->
<div class="header" style="background-image: url(../img/bgr/book.png);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Online Booking</h1>
            </div>
        </div>
        <div class="isi">
            <span>It's more than just a hair appointment!</span>
            <p><a href="/">Home</a><i class='bx bx-chevron-right'></i>Online Booking</p>
        </div>
    </div>
</div>

<!-- content section -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Book Now</span>
                <h2>Book Your Treatments</h2>
            </div>
        </div>
        <div class="isi">
            <div class="row justify-content-center">
                <div class="col-md-5 sisi-kiri">
                    <h3>WORKING HOURS</h3>
                    <p>WORKING DAYS <span>10.00 AM - 19.00 PM</span></p>
                    <!-- <p>SUNDAY <span>Closed</span></p> -->
                    <p class="mrk"><span>*</span>National Day Holiday - Closed</p>
                </div>


                <div class="col-md-5">
                    <div class="kotak-content mx-auto">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <form method="post" action="/books">
                                    @csrf
                                    <p class="title-kotak"  id="success" >Make Your Appointment</p>
                                    <input type="hidden" name="package" value="0">

                                    <label for="service_id" class="form-label"><span>*</span> Services</label>
                                    <select class="form-select mb-2" aria-label="Default select example" name="service_id" id="service_id">
                                        @foreach ($layanan as $layan)
                                        @if(old('service_id') == $layan->id)
                                        <option value="{{ $layan->name }}" selected>{{ $layan->name }}</option>
                                        @else
                                        <option value="{{ $layan->name }}">{{ $layan->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>

                                    <label for="datepicker" class="form-label"><span>*</span> Pick Date</label>

                                    <div class="input-group date mb-5" id="datepicker">
                                        <span class="input-group-text"><i class='bx bxs-calendar'></i></span>
                                        <input type="datetime-local" class="form-control @error('schedule') is-invalid @enderror" name="schedule" placeholder="Date" aria-label="Username" aria-describedby="datepicker" value="{{ old('') }}">
                                        @error('schedule')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!-- 
                                    <p class="title-kotak">Confirm Your Appointment</p>
                                    <div class="mb-3">
                                        <label for="servicepicked" class="form-label">Your Service</label>
                                        <input type="email" class="form-control" id="servicepicked" placeholder="isi berdasarkan data" disabled>
                                    </div>
                                    <div class="mb-3 input-group">
                                        <span class="input-group-text">Date & Time</span>
                                        <input type="text" aria-label="Picked Date" class="form-control" disabled>
                                        <input type="text" aria-label="Picked Time" class="form-control" disabled>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Price</span>
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" disabled>
                                    </div> -->
                                    <div class="input-group mt-3 ">
                                        <button type="button" class="btn bg-btn " data-bs-toggle="modal" id="save" name="save" data-bs-target="#appointmentModal">
                                            Make Appointment
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        <i class="fa fa-exclamation-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>

                <!-- Modal -->
                <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Almost done</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="question" autocomplete="off" value="{{ old('name') }}" placeholder="Indah Wulandari">
                                    <label for="name">Name</label>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" autocomplete="off" placeholder="qwe@qwe.qwe">
                                    <label for="email">Email</label>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" autocomplete="off" placeholder="(+62) 0890897699">
                                    <label for="phone">Phone Number (optional)</label>
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="fnote" placeholder="Estimasi waktu 10 menit perawatan" id="fnote" style="height: 150px;">{{ old('fnote') }}</textarea>
                                    <label for="fnote">Add Notes (optional)</label>
                                    @error('fnote')
                                    <p class="invalid-feedback">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-success">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Button trigger modal -->
            </div>
        </div>
    </div>
</div>

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

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    config = {
        enableTime: true,
        minTime: "8:00",
        maxTime: "22:00",
        dateFormat: "Y-m-d H:i",
        altInput: true,
        altFormat: "F j, Y (h:i K)",
        minDate: "today",
        time_24hr: true
    }
    flatpickr("input[type=datetime-local]", config);


    // function hidd() {
    //     var x = document.getElementById("pills-tab");
    //     if (x.style.display === "none") {
    //         x.style.display = "block";
    //     } else {
    //         x.style.display = "none";
    //     }
    // }
</script>

@endsection