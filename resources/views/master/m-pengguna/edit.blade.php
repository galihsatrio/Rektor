@extends('layout.master')

@section('title', 'Pengguna')
@section('header-content')
    <h1 class="judul-page">Pengguna</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/agenda">Master</a></div>
        <div class="breadcrumb-item"><a href="/pengguna">Pengguna</a></div>
        <div class="breadcrumb-item"><a href="/pengguna">Index</a></div>
        <div class="breadcrumb-item">Edit</div>
    </div>
@endsection

@section('header-body')
    <div class="card">
        <div class="card-header">
            <h4>Ubah Pengguna</h4>
        </div>
        <div class="card-body">
            <form action="/pengguna/update/{{$model->id}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control form-control-sm" name="nama" id="nama" value="{{ $model->nama }}">
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-sm" name="email" id="email" value="{{ $model->email }}">
                    </div>
                </div>
                @if($model->role !== 'admin')
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="email">Role</label>
                        <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                            <option value=""> - Pilih Role - </option>
                            <option value="dosen" @if($model->role == 'Dosen' ? 'selected' : '') @endif>Dosen</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password">
                            <div class="input-group-append">
                                <div class="input-group-text" role="button" onclick="changeType()">
                                    <i class="fas fa-eye" id="mata"></i>
                                </div>
                            </div>
                      </div>
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="password">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke text-right">
            <a href="/pengguna" class="btn btn-secondary btn-sm mr-1">
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

    <script>
        var password = false;
        function changeType() {
            password = !password;
            if (password) {
                document.getElementById('password').type = "text";
                document.getElementById('mata').classList.remove('fa-eye');
                document.getElementById('mata').classList.add('fa-eye-slash');
            } else {
                document.getElementById('password').type = "password";
                document.getElementById('mata').classList.remove('fa-eye-slash');
                document.getElementById('mata').classList.add('fa-eye');
            }
        }
    </script>
@endsection
