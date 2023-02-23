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
                    <a href="/formulir/employees" class="text-decoration-none">
                        <button class="btn-circle text-white">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </a>
                    <h6 class="my-2 mx-3">Ubah Blog & News</h6>
                </div>
                <form method="POST" action="/formulir/employees/{{ $employ->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" autocomplete="off" value="{{ old('nama', $employ->nama) }}" placeholder="botak lebih indah">
                        <label for="nama">Nama Karayawan</label>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @if (old('jk', $employ->jk) == 'Wanita')
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="radio" name="jk" id="jk1" value="Wanita" checked>
                        <label class="form-check-label" for="jk1">Wanita</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" id="jk2" value="Pria" >
                        <label class="form-check-label" for="jk2">Pria</label>
                    </div>
                    @else
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="radio" name="jk" id="jk1" value="Wanita">
                        <label class="form-check-label" for="jk1">Wanita</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" id="jk2" value="Pria" checked>
                        <label class="form-check-label" for="jk2">Pria</label>
                    </div>
                    @endif
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control bg-dark @error('no_telp') is-invalid @enderror" name="no_telp" id="no_telp" value="{{ old('no_telp', $employ->no_telp) }}" autocomplete="off" placeholder="botak-lebih-indah">
                        <label for="no_telp">Nomor Telephone</label>
                        @error('no_telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control bg-dark @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $employ->email) }}" autocomplete="off" placeholder="botak-lebih-indah">
                        <label for="email">Email (Opsional)</label>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" name="image" class="form-label">Tambahkan gambar (thumbnail)</label>
                        @if ($employ->image)
                        <img class="img-preview img-fluid mb-3 col-sm-5 d-block" src="{{ asset('storage/' . $employ->image) }}">
                        @else
                        <img class="img-preview img-fluid mb-3 col-sm-5 d-block">
                        @endif
                        <input class="form-control bg-dark @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*" onchange="previewImage()">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="category_id" id="category_id">
                            @foreach ($jobs as $job)
                            @if(old('category_id', $employ->category_id) == $job->id)
                            <option value="{{ $job->id }}" selected>{{ $job->name }}</option>
                            @else
                            <option value="{{ $job->id }}">{{ $job->name }}</option>
                            @endif
                            @endforeach
                            <!-- <option value="1" selected>Blog</option> -->
                        </select>
                        <label for="category_id">Pilih jabatan karyawan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="alamat" placeholder="Estimasi waktu 10 menit perawatan" id="alamat" style="height: 150px;">{{ old('alamat', $employ->alamat) }}</textarea>
                        <label for="alamat">Alamat (opsional)</label>
                        @error('alamat')
                        <p class="invalid-feedback">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <button class="btn btn-outline-success w-100 my-2" type="submit">Simpan Perubahan</button>
                </form>
            </div>

        </div>

        <!-- bagian keterangan -->
        <div class="col-sm-12 col-xl-5">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Petunjuk Pengisian Data</h6>
                <div class="form-floating mb-3">
                    <h6>Nama Karyawan</h6>
                    <p>Nama karyawan wajib diisi <br>Panjang dari nama tidak boleh lebih dari 200 karakter</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Nomor Telephone</h6>
                    <p>Nomor telephone harus diisi walau pun sekedar angka acak</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Email</h6>
                    <p>Email bersifat opsional <br>Jika diisi maka harus menggunakan email yang valid</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Gambar</h6>
                    <p>Gambar hanya bisa diisi dengan menggunakan file gambar <br>Gambar akan ditampilkan dihalaman Career Oportunity</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Jabatan Karyawan</h6>
                    <p>Jabatan harus dipilih agar bisa menjalankan autentifikasi saat melakukan login</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Alamat</h6>
                    <p>Alamat bersifat opsional<br>Alamat diisi dengan menggunakan teks maksimal panjang karakter adalah 200</p>
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
        fetch('/formulir/employees/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })
</script>
@endsection