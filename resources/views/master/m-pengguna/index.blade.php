@extends('layout.master')

@section('title', 'Pengguna')
@section('header-content')
    <h1 class="judul-page">Pengguna</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/pengguna">Master</a></div>
        <div class="breadcrumb-item"><a href="/pengguna">Pengguna</a></div>
        <div class="breadcrumb-item">Index</div>
    </div>
@endsection

@section('header-body')
    <div class="card">
        <div class="card-header">
            <h4>Pengguna</h4>
            <a href="/pengguna/create" class="btn btn-primary btn-sm ml-auto">
                <i class="fa fa-plus mr-1"></i>
                Tambah Pengguna
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <tbody>
                        <tr class="text-center">
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        @foreach ( $model as $value )
                        <tr class="text-center">
                            <td class="text-left">{{ $value->nama }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->role }}</td>
                            <td>
                                @if ($value->email !== 'admin@gmail.com' && $value->email !== 'rektor@gmail.com')
                                <a href="/pengguna/edit/{{ $value->id }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm"  id="hapus" onclick="hapus({{$value->id}});">
                                    <i class="fa fa-trash"></i>
                                </button>
                                @endif
                                <form action="/pengguna/delete/{{$value->id}}" method="POST" id="formHapus{{$value->id}}">
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
                text: "Menghapus data agenda akan berpengaruh terhadap data lainya!",
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
