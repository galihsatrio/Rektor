@extends('layout.master')

@section('title', 'Tambah Dosen')
@section('header-content')
    <h1 class="judul-page">Dosen</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/dosen">Master</a></div>
        <div class="breadcrumb-item"><a href="/dosen">Dosen</a></div>
        <div class="breadcrumb-item"><a href="/dosen">Index</a></div>
        <div class="breadcrumb-item">Create</div>
    </div>
@endsection

@section('header-body')
    <div class="card">
        <div class="card-header">
            <h4>Tambah Dosen</h4>
        </div>
        <div class="card-body">
            <form action="/dosen/simpan" method="POST">
            @csrf
            <div class="row">
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="nama">Nama Dosen</label>
                        <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{old('nama')}}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="nidn">NIDN</label>
                        <input type="text" class="form-control form-control-sm @error('nidn') is-invalid @enderror" name="nidn" id="nidn" value="{{old('nidn')}}">
                        @error('nidn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="prodi">Prodi</label>
                        <input type="text" class="form-control form-control-sm @error('prodi') is-invalid @enderror" name="prodi" id="prodi" value="{{old('prodi')}}">
                        @error('prodi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="jabatan_akademik">Jabatan Akademik</label>
                        <input type="text" class="form-control form-control-sm @error('jabatan_akademik') is-invalid @enderror" name="jabatan_akademik" id="jabatan_akademik" value="{{old('jabatan_akademik')}}">
                        @error('jabatan_akademik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="golongan_kepangkatan">Golongan Kepangkatan</label>
                        <select class="form-control form-control-sm @error('golongan_kepangkatan') is-invalid @enderror" name="golongan_kepangkatan" id="golongan_kepangkatan" value="{{old('golongan_kepangkatan')}}">
                            <option value=""> - Pilih Golongan Kepangkatan - </option>
                            <option value="I A">I A</option>
                            <option value="I B">I B</option>
                            <option value="I C">I C</option>
                            <option value="I D">I D</option>
                            <option value="II A">II A</option>
                            <option value="II B">II B</option>
                            <option value="II C">II C</option>
                            <option value="II D">II D</option>
                            <option value="III A">III A</option>
                            <option value="III B">III B</option>
                            <option value="III C">III C</option>
                            <option value="III D">III D</option>
                            <option value="IV A">IV A</option>
                            <option value="IV B">IV B</option>
                            <option value="IV C">IV C</option>
                            <option value="IV D">IV D</option>
                        </select>
                        @error('golongan_kepangkatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="status_kerja">Status Ikatan Kerja</label>
                        <input type="text" class="form-control form-control-sm @error('status_kerja') is-invalid @enderror" name="status_kerja" id="status_kerja" value="{{old('status_kerja')}}">
                        @error('status_kerja')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="mulai_aktif">Mulai Aktif</label>
                        <input type="date" class="form-control form-control-sm @error('mulai_aktif') is-invalid @enderror" name="mulai_aktif" id="mulai_aktif" value="{{old('mulai_aktif')}}">
                        @error('mulai_aktif')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="selesai_aktif">Selesai Aktif</label>
                        <input type="date" class="form-control form-control-sm @error('selesai_aktif') is-invalid @enderror" name="selesai_aktif" id="selesai_aktif" value="{{old('selesai_aktif')}}">
                        @error('selesai_aktif')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke text-right">
            <a href="/dosen" class="btn btn-secondary btn-sm mr-1">
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
