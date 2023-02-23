@extends('partial.usr_master')

@section('cssneeded')

<link rel="stylesheet" href="/css/user/header_detail.css">
<link rel="stylesheet" href="/css/user/cart_style.css">

@endsection

@section('content')

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="sub-title">Cart</span>
                <h2> </h2>
            </div>
        </div>

    </div>
</div>

@if (empty($cart))
<div class="container col-md-7 mt-5 mb-5">
    <h4 class="p-5 text-center">No Item</h4>
    <div class="d-flex flex-row align-items-center justify-content-between my-3 p-2 bg-white rounded">
        <button class="btn btn-md ml-2 btn-outline-dark pay-button" data-bs-toggle="modal" data-bs-target="#howtopay" data-bs-whatever="cekot" type="button">How To Pay</button>
        <button class="btn btn-md ml-2 btn-outline-dark pay-button" data-bs-toggle="modal" data-bs-target="#formupload" data-bs-whatever="cekot" type="button">Payment Confirmation</button>
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session()->has('fail'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i>{{ session('fail') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>
@else

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <a href="/shop" class="text-decoration-none text-dark"><span>Back to shop</span></a>
            <?php $total = 0; ?>
            @foreach ($cart as $crt => $val)
            <?php $subtotal = $val['price'] * $val['jumlah']; ?>
            <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded">
                @if ($val['image'])
                <div class="mr-1"><img class="rounded" src="{{ asset('storage/' . $produk->image) }}" width="70"></div>
                @else
                <div class="mr-1"><img class="rounded" src="https://dummyimage.com/400x400/ced4da/6c757d.jpg" width="70"></div>
                @endif
                <div class="d-flex flex-column product-details"><span class="font-weight-bold">{{ $val['name'] }}</span>
                </div>
                <div class="d-flex flex-row qty">
                    <h5 class="text-grey mt-1 mr-1 ml-1">{{ $val['jumlah'] }}</h5>
                </div>
                <div>
                    <h5 class="text-grey">Rp. {{ $subtotal }}</h5>
                </div>
                <form action="/cart/hapus/{{ $crt }}" method="post">
                    @csrf
                    <div class="d-flex align-items-center">
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                </form>
            </div>
            <?php $total += $subtotal; ?>
            @endforeach

            <div class="d-flex flex-row align-items-center mt-3 p-2 bg-white rounded">
                <input type="text" class="form-control border-0 gift-card" placeholder="discount code/gift card">
                <button class="btn btn-outline-dark btn-sm ml-2" type="button">Apply</button>
            </div>
            <div class="d-flex flex-row align-items-center justify-content-between my-3 p-2 bg-white rounded">
                <button class="btn btn-md ml-2 btn-outline-dark pay-button" data-bs-toggle="modal" data-bs-target="#howtopay" data-bs-whatever="cekot" type="button">How To Pay</button>
                <button class="btn btn-md ml-2 btn-outline-dark pay-button" data-bs-toggle="modal" data-bs-target="#cekot" data-bs-whatever="cekot" type="button">Proceed to Pay</button>
                <button class="btn btn-md ml-2 btn-outline-dark pay-button" data-bs-toggle="modal" data-bs-target="#formupload" data-bs-whatever="cekot" type="button">Payment Confirmation</button>
            </div>
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    </div>
</div>

@endif

<!-- modal tutorial -->
<div class="modal fade" id="howtopay" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Payment Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ol>
                    <div class="mb-3">
                        <li>
                            <p class="col-form-label">Please take notes or take a screenshot on the page containing the unique payment code to make future payments</p>
                        </li>
                        <li>
                            <p class="col-form-label">Use this kind of unique Payment Code to be used at the stage of uploading proof of payment</p>
                            <label class="col-form-label"><b>2022081507381482796</b></label>
                        </li>
                        <li>
                            <p class="col-form-label">You are able to make payment using transfer to KireiBeauty official Bank account</p>
                            <ul>
                                <li><label class="col-form-label">BCA : 0590556041</label></li>
                            </ul>
                        </li>
                        <li>
                            <p class="col-form-label">Then access the payment confirmation receipt form with the "Payment Confirmation" button, enter the unique payment code and proof of the transaction (image file)</p>
                        </li>
                        <li>
                            <p class="col-form-label">If there is a change in product payment, it will be given when picking up the goods at the salon</p>
                        </li>
                    </div>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">I Understand</button>
            </div>
        </div>
    </div>
</div>

<!-- modal konfirmasi -->
<div class="modal fade" id="cekot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Check Out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <input type="hidden" name="total" value="{{ $total??0 }}">
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="masukkan nama" value="{{ old('name') }}">
                    <label for="name" class="d-flex align-items-center">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="masukkan no telp" value="{{ old('phone') }}">
                    <label for="phone" class="d-flex align-items-center">Phone</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="masukkan no telp" value="{{ old('email') }}">
                    <label for="email" class="d-flex align-items-center">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="address" placeholder="Estimasi waktu 10 menit perawatan" id="address" style="height: 150px;">{{ old('address') }}</textarea>
                    <label for="address">Address</label>
                </div>
                All fields required

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#cekot1">Continue</button>
            </div>
        </div>
    </div>
</div>

<!-- modal cekout -->
<div class="modal fade" id="cekot1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/cart/transaksi" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="email" id="email2">
                    <input type="hidden" name="total" value="{{ $total??0 }}">
                    <table class="t-conf w-100">
                        <tr>
                            <th>Name</th>
                            <td>:&nbsp;</td>
                            <td><input type="text" class="bg-transparent border-0" name="name" id="name2" readonly> </td>
                        </tr>
                        <tr>
                            <th>Phone </th>
                            <td>:&nbsp;</td>
                            <td><input type="text" class="bg-transparent border-0" name="phone" id="phone2" readonly> </td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>:&nbsp;</td>
                            <td><input type="text" class="bg-transparent w-100 border-0" name="address" id="address2" readonly></td>
                        </tr>
                        <tr>
                            <td>
                                <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>:&nbsp;</td>
                            <td>Rp. {{ $total??0 }}</td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td>:&nbsp;</td>
                            <td>0%</td>
                        </tr>
                        <tr>
                            <th>Order Total</th>
                            <td>:&nbsp;</td>
                            <th>Rp. {{ $total??0 }}</th>
                        </tr>
                    </table>
                    <br>
                    <h5>How To Pay</h5>
                    <p>You have to complete your payment in 2 days</p>
                    <p>Save this Payment Unique Code : <b> {{ $puc = date('YmdHis') . mt_rand(10000, 100000) }}</b></p>
                    <input type="hidden" name="puc" value="{{ $puc }}">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="cekot">Purchase Now</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal upload -->
<div class="modal fade" id="formupload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/cart/konfirmasi" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('puc') is-invalid @enderror" name="puc" id="puc" placeholder="2022081507381482796" value="{{ old('puc') }}">
                        <label for="puc" class="d-flex align-items-center">Payment Unique Code</label>
                    </div>
                    <div class="mb-3">
                        <label for="image" name="image" class="form-label">Upload payment confirmation receipt</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*" onchange="previewImage()">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Confirmation</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('jsneeded')
<script>
    const name = document.querySelector('#name');
    const name2 = document.querySelector('#name2');
    const phone = document.querySelector('#phone');
    const phone2 = document.querySelector('#phone2');
    const email = document.querySelector('#email');
    const email2 = document.querySelector('#email2');
    const address = document.querySelector('#address');
    const address2 = document.querySelector('#address2');

    name.addEventListener('change', function() {
        name2.value = name.value;
    });
    phone.addEventListener('change', function() {
        phone2.value = phone.value;
    });
    address.addEventListener('change', function() {
        address2.value = address.value;
    });
    email.addEventListener('change', function() {
        email2.value = email.value;
    });

    //preview gambar di tampilan admin.post.create
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }

    }
</script>
@endsection