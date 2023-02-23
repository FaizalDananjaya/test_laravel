@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="/css/user/main_style.css">
<link rel="stylesheet" href="/css/responsive/responsive.css">

@endsection

@section('content')

<!-- hero section -->
<section id="hero">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-md-9 hero-tagline mx-auto my-auto">
                <h1>Pada Hari Besarmu <br> Better In Style</h1>
                <p><span class="fw-bold"> Est. 2016</span> <br>We only using high quality product & tools</p>

                <a href="/books/create"><button class="button-lg-primary">BOOK NOW</button></a>
                <!-- <a href="#">
                    <img src="img/Right Arrow.png" alt="">
                 </a> -->
            </div>
        </div>
        <img src="img/aksesoris/gambar model.png" alt="" class="accent-img position-absolute end-0 bottom-0 img-hero">
        <img src="img/aksesoris/arabesque-left-bottom.svg" alt="" class="accent-img img-hero-left position-absolute bottom-0 start-0">
    </div>
</section>

<!-- layanan section -->
<section class="services" id="layanan">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Our Services</span>
                <h2>The Art of Natural Beauty</h2>
            </div>
        </div>
        <div class="services-content">
            <div class="services-content-description">
                <div class="box">
                    <div class="inner">
                        <img src="img/ic/manicure.png">
                        <p>manicure</p>
                    </div>
                </div>
                <div class="box">
                    <div class="inner">
                        <img src="img/ic/pedicure.png">
                        <p>padicure</p>
                    </div>
                </div>
                <div class="box">
                    <div class="inner">
                        <img src="img/ic/makeup.png">
                        <p>makeup</p>
                    </div>
                </div>
                <div class="box">
                    <div class="inner">
                        <img src="img/ic/hairstyle.png">
                        <p>hairstyle</p>
                    </div>
                </div>
                <div class="box">
                    <div class="inner">
                        <img src="img/ic/haircut.png">
                        <p>haircut</p>
                    </div>
                </div>
                <div class="box">
                    <div class="inner">
                        <img src="img/ic/eyebrow design.png">
                        <p>eyebrow design</p>
                    </div>
                </div>
                <div class="box">
                    <div class="inner">
                        <img src="img/ic/waxing.png">
                        <p>waxing</p>
                    </div>
                </div>
                <div class="box">
                    <div class="inner">
                        <img src="img/ic/skin cleansing.png">
                        <p>skin cleansing</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="/layanan" class="text-decoration-none">
                <button type="button" class="btn button-primary">Learn More</button>
            </a>
        </div>
    </div>
</section>

<!-- galeri section -->
<section id="galeri">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Our Gallery</span>
                <h2>Beautiful Hair Starts Here</h2>

            </div>
        </div>

        <div class="galeri-content">
            @foreach ($galeris as $gal)
            <div class="box">
                <img src="{{ asset('storage/' . $gal->image) }}" alt="" class="gallery-item">
            </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="/galeri" class="text-decoration-none">
                <button type="button" class="btn button-primary">More..</button>
            </a>
        </div>
    </div>

</section>

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

<!-- package section-->
<section id="paket">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Best Deal</span>
                <h2>Caring For Your Comforts</h2>
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
                <div class="text-center">
                    <a href="/books/create" class="text-decoration-none">
                        <button class="btn_paket">I want this</button>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="/pakets" class="text-decoration-none">
                <button type="button" class="btn button-primary">More</button>
            </a>
        </div>
    </div>
</section>



<section id="testimonial">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Testimonials</span>
                <h2>What Our Clients Say</h2>
            </div>
        </div>

        <div class="row text-center d-flex align-items-stretch justify-content-between">
            @foreach ($testi as $test)
            <div class="col-md-4 mb-5 mb-md-0 d-flex align-items-stretch">
                <div class="card testimonial-card">
                    <div class="card-up" style="background-color: #EBBBB0;"></div>
                    <div class="avatar mx-auto bg-white">
                        @if ($test->image)
                        <img src="{{ asset('storage/' . $test->image) }}" class="rounded-circle img-fluid">
                        @else
                        <img src="/img/galeri/photo5.png" class="rounded-circle img-fluid" >
                        @endif
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">{{ $test->name??"Our Customer"}}</h4>
                        <hr />
                        <p class="dark-grey-text mt-4">
                            <i class="fas fa-quote-left pe-2"></i>{{ $test->feedback }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- news section -->
<section id="blog">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Our Blog</span>
                <h2>Latest News & Events</h2>
            </div>
        </div>

        <div class="row owl-carousel owl-theme">
            @foreach ($posts as $post)
            <div class="card-berita my-1">
                <div class="box-icon mx-auto">
                    @if ($post->image)
                    <div class="post-gambar">
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" />
                    </div>
                    @else
                    <img src="/img/galeri/photo1.png" class="img-fluid" />
                    @endif
                    <!-- <img src="{{ $post->image }}" alt=""> -->
                </div>
                <span>{{ $post->category->name??'uncategorized' }}</span>
                <a href="">
                    <h3>{{ $post->title }}</h3>
                </a>
                <p>{{ $post->excerpt?$post->excerpt:strip_tags($post->body) }}</p>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="/blog" class="text-decoration-none">
                <button type="button" class="btn button-primary">More</button>
            </a>
        </div>
    </div>
</section>

<!-- contact section -->
<section id="contact">
    <div class="container-fluid h-100">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Want to Make a Booking or Have a Question?</h3>
                    <a href="/kontaks" class="btn button-tanya btn-outline-light">Contact Now</a>
                </div>
                <div class="col-md-6">
                    <div class="card-contact w-100">
                        <form action="/kontaks" method="POST">
                            @csrf
                            <h2>Any Questions..?</h2>
                            <input type="hidden" name="name" value="Anonymous">
                            <input type="hidden" name="about" value="Random">
                            <input type="hidden" name="title" value="via halaman Home">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="masukkan email" value="{{ old('email') }}">
                                <label for="email" class="d-flex align-items-center">Email Address</label>
                            </div>

                            <div class="form-floating">
                                <input type="text" class="form-control" name="body" id="body" placeholder="masukkan pertanyaan" value="{{ old('body') }}">
                                <label for="floatingtanya" class="d-flex align-items-center">Your Question</label>
                            </div>

                            <button class="button-contact btn btn-outline-dark" type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('jsneeded')

<script src="js/script.js"></script>

<!-- owl carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })

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