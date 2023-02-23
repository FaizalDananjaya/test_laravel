@extends('partial.adm_master')

@section('cssneeded')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"></style>
@endsection

@section('admin_content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- mulai form -->
        <div class="col-sm-12 col-xl-7">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="mb-4 d-flex">
                    <a href="/formulir/services" class="text-decoration-none">
                        <button class="btn-circle text-white">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </a>
                    <h6 class="my-2 mx-3">Tambah Paket</h6>
                </div>
                <form method="POST" action="/formulir/packages" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" autocomplete="off" value="{{ old('name') }}" placeholder="botak lebih indah">
                        <label for="name">Nama Paket</label>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control bg-dark @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price') }}" autocomplete="off" placeholder="botak-lebih-indah">
                        <label for="price">Harga Paket</label>
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!-- <div class="form-floating mb-3"> -->
                        <label for="category">Pilih layanan yang ingin ditambahkan ke paket</label>
                        <select class="selectpicker d-block w-100" name="service_id[]" multiple id="category">
                            @foreach ($services as $serv)
                            @if(old('service_id') == $serv->id)
                            <option value="{{ $serv->id }}" selected>{{ $serv->name }}</option>
                            @else
                            <option value="{{ $serv->id }}">{{ $serv->name }}</option>
                            @endif
                            @endforeach
                            <!-- <option value="1" selected>Blog</option> -->
                        </select>
                    <!-- </div> -->
                    <button class="btn btn-outline-success w-100 my-2" type="submit">Simpan</button>
                </form>
            </div>
        </div>

        <!-- bagian keterangan -->
        <div class="col-sm-12 col-xl-5">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Petunjuk Pengisian Data</h6>
                <div class="form-floating mb-3">
                    <h6>Nama Paket</h6>
                    <p>Nama paket wajib diisi <br>Panjang dari nama tidak boleh lebih dari 200 karakter</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Harga Paket</h6>
                    <p>Harga harus diisi dengan menggunakan angka <br>Panjang dari harga tidak boleh lebih dari 6 karakter
                </div>
                <div class="form-floating mb-3">
                    <h6>Pilihan Layanan</h6>
                    <p>Pilihan layanan merupakan layanan-layanan yang akan ditambahkan untuk paket terkait</p>
                </div>
                Pastikan tidak ada data yang kosong sebelum menekan tombol "Simpan".
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsneeded')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
<script>
    $('select').selectpicker();

    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function() {
        fetch('/formulir/services/checkSlug?name=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
</script>
@endsection