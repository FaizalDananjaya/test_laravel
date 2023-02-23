@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="css/user/header_detail.css">
<link rel="stylesheet" href="css/user/galeri_style.css">

@endsection

@section('content')

<!-- hero section -->
<div class="header" style="background-image: url(../img/bgr/galeri.png);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Gallery</h1>
            </div>
        </div>
        <div class="isi">
            <span>Providing you with awesome art viewing</span>
            <p><a href="/">Home</a><i class='bx bx-chevron-right'></i>Gallery </p>
        </div>
    </div>
</div>

<!-- konten -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Our Gallery</span>
                <h2>Beautiful Hair Starts Here</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 m-auto ">
                <div class="items d-flex flex-wrap">
                    <span class="item active mb-1" data-name="all">All</span>
                    @foreach ($servis as $serv)
                    <span class="item mb-1" data-name="{{ $serv->name }}">{{ $serv->name}}</span>
                    @endforeach
                </div>
                <div class="gallery">
                    @foreach ($gambar as $gbr)
                    <div class="image" style="max-height:265px;overflow:hidden" data-name="{{ $gbr->service->name }}"><span><img class="gallery-item" src="{{ asset('storage/' . $gbr->image) }}" alt=""></span></div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Modal untuk galeri-->
<div class="modal fade" id="gallery-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="img/galeri/photo1.png" class="modal-img" alt="">
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsneeded')

<script src="js/script.js"></script>
<script src="js/galeri_jasc.js"></script>

<script>
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("gallery-item")) {
            const src = e.target.getAttribute("src");
            document.querySelector(".modal-img").src = src;
            const myModal = new bootstrap.Modal(document.getElementById('gallery-modal'));
            myModal.show();
        }
    })
</script>


@endsection