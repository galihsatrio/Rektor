@extends('layout.master')

@section('title', 'Mahasiswa')
@section('header-content')
    <h1 class="judul-page">Mahasiswa</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/mahasiswa">Master</a></div>
        <div class="breadcrumb-item"><a href="/mahasiswa">Mahasiswa</a></div>
        <div class="breadcrumb-item">Index</div>
    </div>
@endsection

@section('header-body')
    <div class="card">
        <div class="card-header">
            <h4>Mahasiswa</h4>
            <div class="card-header-form">
                <form method="/mahasiswa" >
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search.." name="search">
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col text-right py-3">
                    <a href="/mahasiswa/create" class="btn btn-primary btn-sm mr-4">
                        <i class="fa fa-plus mr-1"></i>
                        Tambah Mahasiswa
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <tbody>
                        <tr class="text-center">
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email Akademik</th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                            <th>Aksi</th>
                        </tr>
                        @foreach ( $model as $value )
                        <tr class="text-center">
                            <td class="text-center">{{ $value->nim }}</td>
                            <td class="text-left">{{ $value->nama }}</td>
                            <td class="text-left">{{ $value->email_akademik }}</td>
                            <td class="text-left">{{ $value->prodi }}</td>
                            <td>{{ $value->angkatan}}</td>
                            <td>
                                <a href="/mahasiswa/edit/{{ $value->id }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm"  id="hapus" onclick="hapus({{$value->id}});">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form action="/mahasiswa/delete/{{$value->id}}" method="POST" id="formHapus{{$value->id}}">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke text-right">
            <nav class="d-inline-block">
                {{$model->links()}}
            </nav>
        </div>
    </div>
    <script>
        function hapus(id) {
            swal({
                title: "Apakah anda yakin?",
                text: "Menghapus data Mahasiswa akan berpengaruh terhadap data lainya!",
                icon: "warning",
                buttons: ["Tidak", "Hapus"],
                dangerMode: true,
            }).then((hapus) => {
                if (hapus) {
                    document.getElementById("formHapus"+id).submit();
                }
            });
        }
    </script>
@endsection
