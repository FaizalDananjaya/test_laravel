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
                    <a href="/formulir/faqs" class="text-decoration-none">
                        <button class="btn-circle text-white">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </a>
                    <h6 class="my-2 mx-3">Tambah FAQs & Help</h6>
                </div>
                <form method="POST" action="/formulir/faqs">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('question') is-invalid @enderror" name="question" id="question" autocomplete="off" value="{{ old('question') }}" placeholder="botak lebih indah">
                        <label for="question">Pertanyaan</label>
                        @error('question')
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
                    <div class="form-floating mb-3">
                        <select class="form-select" name="category_id" id="category_id">
                            @foreach ($categories as $kate)
                            <option value="{{ $kate->id }}">{{ $kate->name }}</option>
                            @endforeach
                            <!-- <option value="1" selected>Blog</option> -->
                        </select>
                        <label for="category">Tambahkan kategori pada data</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="answer" placeholder="Estimasi waktu 10 menit perawatan" id="answer" style="height: 150px;">{{ old('answer') }}</textarea>
                        <label for="answer">Jawaban</label>
                        @error('answer')
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
                    <h6>Pertanyaan</h6>
                    <p>Pertanyaan bisa diisikan dengan pertanyaan yang sering diajukan<br>Panjang dari judul tidak boleh lebih dari 200 karakter</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Slug</h6>
                    <p>Slug merupakan url yang akan diakses oleh pengguna<br>Slug tidak perlu diisi karena sudah ter-generate secara otomatis</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Kategori Pertayaan</h6>
                    <p>Kategori pertanyaan akan digunakan sebagai tag pencarian terkait</p>
                </div>
                <div class="form-floating mb-3">
                    <h6>Jawaban dari Pertayaan</h6>
                    <p>Jawaban harus diisi dengan teks <br>Jawablah pertanyaan dengan detail. Bagian ini wajib diisi</p>
                </div>
                Pastikan tidak ada data yang kosong sebelum menekan tombol "Simpan".
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsneeded')
<script>
    const name = document.querySelector('#question');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function() {
        fetch('/formulir/faqs/checkSlug?name=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

</script>
@endsection