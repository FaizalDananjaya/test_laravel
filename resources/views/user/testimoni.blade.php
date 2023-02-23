@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="css/user/header_detail.css">
<link rel="stylesheet" href="css/user/faq_style.css">
<link rel="stylesheet" href="css/partial/promo.css">

@endsection

@section('content')

<!-- content section -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Testimonials</span>
                <h2>What Our Clients Say</h2>
            </div>
        </div>

        <section>
            <!-- <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-xl-8 text-center">
                <h3 class="mb-4">Testimonials</h3>
                <p class="mb-4 pb-2 mb-md-5 pb-md-0"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur veniam. </p>
            </div>
        </div> -->
            <div class="row text-center">
                @foreach( $testims as $tess)
                <div class="col-md-4 mb-5 mb-md-0">
                    <div class="d-flex justify-content-center mb-4">
                        @if ($tess->image)
                        <img src="{{ asset('storage/' . $tess->image) }}" class="rounded-circle shadow-1-strong" width="150" height="150">
                        @else
                        <img src="/img/galeri/photo5.png" class="rounded-circle shadow-1-strong" width="150" height="150">
                        @endif
                    </div>
                    <h5 class="mb-3">{{ $tess->name??"Our Customer" }}</h5>
                    <h6 class="text-primary mb-3">{{ $tess->profession?? "" }}</h6>
                    <p class="px-xl-3"> <i class="fas fa-quote-left pe-2"></i>{{ $tess->feedback }}</p>
                </div>
                @endforeach

            </div>
        </section >

        <div class="col-xl-12 col-sm-12 text-center my-5">
            <button class="btn btn-md ml-2 btn-outline-dark pay-button" data-bs-toggle="modal" data-bs-target="#review" data-bs-whatever="cekot" type="button">Write us your opinion</button>

            <div class="col-xl-7 col-sm-12 mt-3 mx-auto text-start">
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
        </div>

        <section>
            <div class="row text-center">
                @foreach( $testims2 as $tess)
                <div class="col-md-4 mb-5 mb-md-0">
                    <div class="d-flex justify-content-center mb-4">
                        @if ($tess->image)
                        <img src="{{ asset('storage/' . $tess->image) }}" class="rounded-circle shadow-1-strong" width="150" height="150">
                        @else
                        <img src="/img/galeri/photo5.png" class="rounded-circle shadow-1-strong" width="150" height="150">
                        @endif
                    </div>
                    <h5 class="mb-3">{{ $tess->name??"Our Customer" }}</h5>
                    <h6 class="text-primary mb-3">{{ $tess->profession?? "" }}</h6>
                    <p class="px-xl-3"> <i class="fas fa-quote-left pe-2"></i>{{ $tess->feedback }}</p>
                </div>
                @endforeach

            </div>
        </section>

    </div>
</div>


<div class="modal fade" id="review" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/testimonials" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Jesicca" value="{{ old('name') }}" autocomplete="off">
                        <label for="name" class="d-flex align-items-center">Name (optional)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('profession') is-invalid @enderror" name="profession" id="profession" placeholder="Jesicca" value="{{ old('profession') }}" autocomplete="off">
                        <label for="profession" class="d-flex align-items-center">Profession (optional)</label>
                    </div>
                    <div class="mb-3">
                        <label for="image" name="image" class="form-label">Upload your picture</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*" onchange="previewImage()">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="feedback" placeholder="Estimasi waktu 10 menit perawatan" id="feedback" style="height: 150px;">{{ old('feedback') }}</textarea>
                        <label for="feedback">Your Opinion</label>
                        @error('feedback')
                        <p class="invalid-feedback">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('jsneeded')
@endsection