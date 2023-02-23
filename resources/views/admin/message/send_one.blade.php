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
                    <a href="/pesans" class="text-decoration-none">
                        <button class="btn-circle text-white">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </a>
                    <h6 class="my-2 mx-3">Tambah Pesan</h6>
                </div>
                <form method="POST" action="/kirimpesans" enctype="multipart/form-data">
                    @csrf
                    <h6 class="mb-4">Kirim Pesan ke Email tertentu</h6>
                    <input type="hidden" name="employee_id" value="{{ auth()->user()->employee_id }}">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Potong Cepak" value="{{ old('title', $title) }}" autocomplete="off" required>
                        <label for="title">Judul Pesan</label>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="tujuan" placeholder="Potong Cepak" value="{{ old('email', $email) }}" autocomplete="off" required>
                        <label for="email">Tujuan Pesan (Email)</label>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                            @foreach ($kategoris as $kategori)
                            @if(old('category_id', $kat_rep) == $kategori->id)
                            <option value="{{ $kategori->id }}" selected>{{ $kategori->name }}</option>
                            @else
                            <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        <label for="floatingSelect">Pilih kategori pesan</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control @error('body') is-invalid @enderror" placeholder="Estimasi waktu 10 menit perawatan" name="body" id="body" style="height: 150px;" required>{{ old('body') }}</textarea>
                        <label for="body">Isi pesan</label>
                        @error('body')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button class="btn btn-outline-info w-100 my-2" type="submit">Kirim</button>
                </form>
            </div>
        </div>

        <!-- bagian keterangan -->
        <div class="col-sm-12 col-xl-5">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Petunjuk Pengisian Data</h6>
                <div class="form-floating mb-3">
                    <h6>Judul Pesan</h6>
                    <p>Judul pesan wajib diisi <br>Judul pesan berguna untuk mencari pesan, maksimal karakter 30</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Tujuan Pesan</h6>
                    <p>Tujuan pesan diisi dengan email dari orang yang dituju<br>Jangan masukkan sembarang email yang tidak terdaftar, atau mengirimkan pesan ke email milik perusahaan lain</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Kategori Pesan</h6>
                    <p>Kategori pesan berguna untuk melakukan pengelompokan pesan<br>Pilih dari beberapa pilihan yang tersedia</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Isi Pesan</h6>
                    <p>Isi pesan harus diisi dengan menggunakan teks <br>Panjang dari isi pesan tidak boleh lebih dari 200 karakter
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
        fetch('/formulir/services/checkSlug?name=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
</script>
@endsection