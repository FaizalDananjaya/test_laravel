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
                    <a href="/formulir/blogs" class="text-decoration-none">
                        <button class="btn-circle text-white">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </a>
                    <h6 class="my-2 mx-3">Tambah Blog & News</h6>
                </div>
                <form method="POST" action="/formulir/blogs" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" autocomplete="off" value="{{ old('title') }}" placeholder="botak lebih indah">
                        <label for="title">Judul</label>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control bg-dark @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug') }}" autocomplete="off" placeholder="botak-lebih-indah" readonly>
                        <label for="slug">Slug</label>
                        @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" name="image" class="form-label">Tambahkan gambar (thumbnail)</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        <input class="form-control bg-dark @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*" onchange="previewImage()">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="category_id" id="category">
                            @foreach ($kategoris as $kategori)
                            @if(old('category_id') == $kategori->id)
                            <option value="{{ $kategori->id }}" selected>{{ $kategori->name }}</option>
                            @else
                            <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                            @endif
                            @endforeach
                            <!-- <option value="1" selected>Blog</option> -->

                        </select>
                        <label for="category">Pilih data untuk kategori</label>
                    </div>
                    <div class="mb-3">
                        <label for="body">Konten</label>
                        @error('body')
                        <p class="invalid-feedback">
                            {{ $message }}
                        </p>
                        @enderror
                        <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                        <trix-editor input="body"></trix-editor>
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
                    <h6>Judul</h6>
                    <p>Judul wajib diisi <br>Panjang dari judul tidak boleh lebih dari 200 karakter</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Slug</h6>
                    <p>Slug merupakan url yang akan diakses oleh pengguna<br>Slug tidak perlu diisi karena sudah ter-generate secara otomatis</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Gambar</h6>
                    <p>Gambar merupakan thumbnail dari setiap post <br>Ukuran file gambar tidak boleh melebihi 1 MB <br>Gambar bersifat opsional atau memiliki ukuran 900x400px</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Kategori</h6>
                    <p>Kategori dapat diartikan sebagai Tag (#) untuk menggolongkan tiap-tiap postingan</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Konten</h6>
                    <p>Konten harus diisi dengan menggunakan teks<br>Konten wajib diisi</p>
                </div>
                Pastikan tidak ada data yang kosong (kecuali yang bersifat opsional) sebelum menekan tombol "Simpan".
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsneeded')
<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch('/formulir/blogs/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })
</script>
@endsection