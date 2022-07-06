@extends('layout.master')

@section('title', 'Dosen')
@section('header-content')
    <h1 class="judul-page">Dosen</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/dosen">Master</a></div>
        <div class="breadcrumb-item"><a href="/dosen">Dosen</a></div>
        <div class="breadcrumb-item">Index</div>
    </div>
@endsection

@section('header-body')
    <div class="card">
        <div class="card-header">
            <h4>Dosen</h4>
            <a href="/dosen/create" class="btn btn-primary btn-sm ml-auto">
                <i class="fa fa-plus mr-1"></i>
                Tambah Dosen
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <tbody>
                        <tr class="text-center">
                            <th>Nama</th>
                            <th>NIDN</th>
                            <th>Prodi</th>
                            <th>Mulai Aktif</th>
                            <th>Selesai Aktif</th>
                            <th>Aksi</th>
                        </tr>
                        @foreach ( $model as $value )
                        <tr class="text-center">
                            <td class="text-left">{{ $value->nama }}</td>
                            <td>{{ $value->nidn }}</td>
                            <td>{{ $value->prodi }}</td>
                            <td>{{ $value->mulai_aktif }}</td>
                            <td>{{ $value->selesai_aktif == null ? '-' : $value->selesai_aktif  }}</td>
                            <td>
                                <a href="/dosen/edit/{{ $value->id }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm"  id="hapus" onclick="hapus({{$value->id}});">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form action="/dosen/delete/{{$value->id}}" method="POST" id="formHapus{{$value->id}}">
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
                text: "Menghapus data dosen akan berpengaruh terhadap data lainya!",
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
