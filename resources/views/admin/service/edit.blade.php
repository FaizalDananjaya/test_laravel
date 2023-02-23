@extends('partial.adm_master')

@section('cssneeded')

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
                    <h6 class="my-2 mx-3">Ubah Data Layanan</h6>
                </div>
                <form method="POST" action="/formulir/services/{{ $serv->slug }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" autocomplete="off" value="{{ old('name', $serv->name) }}" placeholder="botak lebih indah">
                        <label for="name">Nama Layanan</label>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control bg-dark @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug', $serv->slug) }}" autocomplete="off" placeholder="botak-lebih-indah">
                        <label for="slug">Slug</label>
                        @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control bg-dark @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price', $serv->price) }}" autocomplete="off" placeholder="botak-lebih-indah">
                        <label for="price">Harga Layanan</label>
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="category_id" id="category">
                            @foreach ($kategoris as $kategori)
                            @if(old('category_id', $serv->category_id) == $kategori->id)
                            <option value="{{ $kategori->id }}" selected>{{ $kategori->name }}</option>
                            @else
                            <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                            @endif
                            @endforeach
                            <!-- <option value="1" selected>Blog</option> -->
                        </select>
                        <label for="category">Pilih kategori layanan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="desc" placeholder="Estimasi waktu 10 menit perawatan" id="desc" style="height: 150px;">{{ old('desc', $serv->desc)}}</textarea>
                        <label for="desc">Deskripsi</label>
                        @error('desc')
                        <p class="invalid-feedback">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <button class="btn btn-outline-success w-100 my-2" type="submit">Simpan</button>
                </form>
            </div>
        </div>

        <!-- bagian keterangan -->
        <div class="col-sm-12 col-xl-5">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Petunjuk Pengisian Data</h6>
                <div class="form-floating mb-3">
                    <h6>Nama Layanan</h6>
                    <p>Nama layanan wajib diisi <br>Panjang dari nama tidak boleh lebih dari 200 karakter</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Slug</h6>
                    <p>Slug merupakan url yang akan diakses oleh pengguna<br>Slug tidak perlu diisi karena sudah ter-generate secara otomatis</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Harga Layanan</h6>
                    <p>Harga harus diisi dengan menggunakan angka <br>Panjang dari harga tidak boleh lebih dari 6 karakter
                </div>
                <div class="form-floating mb-3">
                    <h6>Kategori</h6>
                    <p>Kategori dapat diartikan sebagai Tag (#) untuk menggolongkan tiap-tiap postingan</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Deskripsi</h6>
                    <p>Deskripsi bersifat opsional<br>Deskripsi diisi dengan menggunakan teks</p>
                </div>
                Pastikan tidak ada data yang kosong (kecuali yang bersifat opsional) sebelum menekan tombol "Simpan".
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsneeded')
<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function() {
        fetch('/formulir/services/checkSlug?name=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
</script>
@endsection