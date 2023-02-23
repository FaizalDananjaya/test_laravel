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
                    <a href="/formulir/categories" class="text-decoration-none">
                        <button class="btn-circle text-white">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </a>
                    <h6 class="my-2 mx-3">Tambah Kategori</h6>
                </div>
                <form method="POST" action="/formulir/categories/{{ $category->id }}">
                    @method('put')
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" autocomplete="off" value="{{ old('name', $category->name) }}" placeholder="botak lebih indah">
                        <label for="name">Nama Kategori</label>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control bg-dark @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" autocomplete="off" placeholder="botak-lebih-indah">
                        <label for="slug">Slug</label>
                        @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="tabel_id" id="tabel_id">
                            @foreach ($tabels as $tabel)
                            @if(old('tabel_id', $category->tabel_id) == $tabel->id)
                            <option value="{{ $tabel->id }}" selected>{{ $tabel->name }}</option>
                            @else
                            <option value="{{ $tabel->id }}">{{ $tabel->name }}</option>
                            @endif
                            @endforeach
                            <!-- <option value="1" selected>Blog</option> -->
                        </select>
                        <label for="category">Tambahkan kategori pada data</label>
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
                    <h6>Nama Kategori</h6>
                    <p>Nama kategori wajib diisi <br>Panjang dari judul tidak boleh lebih dari 200 karakter</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Slug</h6>
                    <p>Slug merupakan url yang akan diakses oleh pengguna<br>Slug tidak perlu diisi karena sudah ter-generate secara otomatis</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Kategori pada data</h6>
                    <p>Kategori pada data adalah data yang ingin ditambahkan kategorinya. Bagian ini wajib diisi</p>
                </div>
                Pastikan tidak ada data yang kosong sebelum menekan tombol "Simpan".
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
        fetch('/formulir/categories/checkSlug?name=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })
</script>
@endsection