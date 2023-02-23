@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="css/user/header_detail.css">
<link rel="stylesheet" href="css/user/toko_style.css">

@endsection

@section('content')

<!-- hero section -->
<div class="header" style="background-image: url(../img/bgr/blog.png);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Shop</h1>
            </div>
        </div>
        <div class="isi">
            <span>We only using high quality product</span>
            <p><a href="/">Home</a><i class='bx bx-chevron-right'></i>Shop</p>
        </div>
    </div>
</div>

<!-- content -->
<div class="content">

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Our Product</span>
                <h2>Always in style</h2>
            </div>
        </div>

        <div class="container px-4 px-lg-5 mt-5 sisi-atas">
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 row-cols-xl-4 justify-content-center">

                @foreach ($produks as $produk)
                <div class="box">
                    <div class="card mb-4 shadow-sm">
                        @if ( $produk->image )
                        <div style="max-height:265px;overflow:hidden">
                            <img src="{{ asset('storage/' . $produk->image) }}" class="img-fluid" />
                        </div>
                        @else
                        <div style="max-height:265px;overflow:hidden">
                            <img src="https://dummyimage.com/400x400/ced4da/6c757d.jpg" class="img-fluid" />
                        </div>
                        @endif
                        <div class="py-2 px-3 position-absolute" style="background-color:rgba(0,0,0,0.7)"><a class="text-light text-decoration-none">{{ $produk->category->name  }}</a></div>

                        <div class="card-body">
                            <div class="text-start">
                                <!-- harga Produk-->
                                <span class="fw-bolder">Rp. {{ $produk->price }}</span>
                                <!-- nama Produk-->
                                <span>{{ $produk->name }}</span>
                                <span>{{ $produk->desc }}</span>
                            </div>
                        </div>
                        <form action="/cart/tambah/{{ $produk->id }}" method="post">
                            @csrf
                            <div class="card-footer py-4 px-3 pt-0 border-top-0 bg-transparent">
                                <div class="text-start d-flex justify-content-between">
                                    <div class="quantity">
                                        <input type="number" min="1" name="jumlah" class="num" value="1">
                                    </div>
                                    <button type="submit" class="btn btn-outline-dark mt-auto">Add to cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        <div class="d-flex justify-content-center">{{ $produks->links() }}</div>

    </div>
</div>

@endsection

@section('jsneeded')
@endsection