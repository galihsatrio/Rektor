@extends('layout.master')

@section('title', 'Agenda')
@section('header-content')
    <h1 class="judul-page">Agenda</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/agenda">Master</a></div>
        <div class="breadcrumb-item"><a href="/agenda">Agenda</a></div>
        <div class="breadcrumb-item">Index</div>
    </div>
@endsection

@section('header-body')
    <div class="card">
        <div class="card-header">
            <h4>Agenda Rektor</h4>
            <a href="/agenda/create" class="btn btn-primary btn-sm ml-auto">
                <i class="fa fa-plus mr-1"></i>
                Buat Agenda
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <tbody>
                        <tr class="text-center">
                            <th>Agenda</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Prioritas</th>
                            <th>Aksi</th>
                        </tr>
                        @foreach ( $model as $value )
                        <tr class="text-center">
                            <td class="text-left">{{ $value->nama_agenda }}</td>
                            <td>{{ $value->tanggal }}</td>
                            <td>{{ $value->jam }}</td>
                            <td>
                                @if( $value->status == 1 )
                                    <div class="badge badge-success badge-pill">Wajib</div>
                                @else
                                    <div class="badge badge-warning badge-pill">Tidak Wajib</div>
                                @endif
                            </td>
                            <td>
                                <a href="/agenda/edit/{{ $value->id }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm"  id="hapus" onclick="hapus({{$value->id}});">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form action="/agenda/delete/{{$value->id}}" method="POST" id="formHapus{{$value->id}}">
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
