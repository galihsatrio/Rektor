@extends('layout.master')

@section('title', 'Mahasiswa')
@section('header-content')
    <h1 class="judul-page">Mahasiswa</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/mahasiswa">Master</a></div>
        <div class="breadcrumb-item"><a href="/mahasiswa">Mahasiswa</a></div>
        <div class="breadcrumb-item"><a href="/mahasiswa">Index</a></div>
        <div class="breadcrumb-item">Edit</div>
    </div>
@endsection

@section('header-body')
    <div class="card">
        <div class="card-header">
            <h4>Ubah Mahasiswa</h4>
        </div>
        <div class="card-body">
            <form action="/mahasiswa/update/{{$model->id}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control form-control-sm @error('nim') is-invalid @enderror" name="nim" id="nim" value="{{ $model->nim }}">
                        @error('nim')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ $model->nama }}">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="email_akademik">Email Akademik</label>
                        <input type="email" class="form-control form-control-sm @error('email_akademik') is-invalid @enderror" name="email_akademik" id="email_akademik" value="{{ $model->email_akademik }}">
                        @error('email_akademik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="prodi">Prodi</label>
                        <select class="form-control @error('prodi') is-invalid @enderror" name="prodi" id="prodi" value="{{old('prodi')}}">
                            <option value=""> - Pilih Prodi - </option>
                            <option value="Teknologi Informasi" {{ $model->prodi == 'Teknologi Informasi' ? 'selected' : '' }} >Teknologi Informasi</option>
                            <option value="Teknologi Komputer" {{ $model->prodi == 'Teknologi Komputer' ? 'selected' : '' }} >Teknologi Komputer</option>
                            <option value="Teknologi Rekayasa Perangkat Lunak" {{ $model->prodi == 'Teknologi Rekayasa Perangkat Lunak' ? 'selected' : '' }} >Teknologi Rekayasa Perangkat Lunak</option>
                            <option value="Informatika" {{ $model->prodi == 'Informatika' ? 'selected' : '' }} >Informatika</option>
                            <option value="Teknik Elektro" {{ $model->prodi == 'Teknik Elektro' ? 'selected' : '' }} >Teknik Elektro</option>
                            <option value="Teknik Biopres" {{ $model->prodi == 'Teknik Biopres' ? 'selected' : '' }} >Teknik Biopres</option>
                            <option value="Sistem Informasi" {{ $model->prodi == 'Sistem Informasi' ? 'selected' : '' }} >Sistem Informasi</option>
                            <option value="Manajemen Rekayasa" {{ $model->prodi == 'Manajemen Rekayasa' ? 'selected' : '' }} >Manajemen Rekayasa</option>
                        </select>
                        @error('prodi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="angkatan">Angkatan</label>
                        <input type="text" class="form-control form-control-sm @error('angkatan') is-invalid @enderror" name="angkatan" id="angkatan" value="{{ $model->angkatan }}">
                        @error('angkatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke text-right">
            <a href="/mahasiswa" class="btn btn-secondary btn-sm mr-1">
                <i class="mr-1 fa fa-chevron-left"></i>
                Kembali
            </a>
            <button class="btn btn-primary btn-sm mr-1">
                <i class="mr-1 fa fa-save"></i>
                Simpan
            </button>
            </form>
        </div>
    </div>
@endsection
