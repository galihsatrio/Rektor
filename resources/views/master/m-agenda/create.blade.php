@extends('layout.master')

@section('title', 'Agenda')
@section('header-content')
    <h1 class="judul-page">Agenda</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/agenda">Master</a></div>
        <div class="breadcrumb-item"><a href="/agenda">Agenda</a></div>
        <div class="breadcrumb-item"><a href="/agenda">Index</a></div>
        <div class="breadcrumb-item">Create</div>
    </div>
@endsection

@section('header-body')
    <div class="card">
        <div class="card-header">
            <h4>Buat Agenda</h4>
        </div>
        <div class="card-body">
            <form action="/agenda/simpan" method="POST">
            @csrf
            <div class="row">
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="nama_agenda">Nama Agenda</label>
                        <input type="text" class="form-control form-control-sm" name="nama_agenda" id="nama_agenda">
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="tempat">Tempat</label>
                        <input type="text" class="form-control form-control-sm" name="tempat" id="tempat">
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control form-control-sm" name="tanggal" id="tanggal">
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <select class="form-control form-control-sm" name="jam" id="jam">
                            <option value=""> - Pilih Jam - </option>
                            <option value="07:00">07:00</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="status">Prioritas</label>
                        <select class="form-control form-control-sm" name="status" id="status">
                            <option value=""> - Pilih Prioritas - </option>
                            <option value="1">Wajib Hadir</option>
                            <option value="0">Tidak Wajib Hadir</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 px-5">
                    <div class="form-group">
                        <label for="keterangan_agenda">Keterangan</label>
                        <textarea type="text" class="form-control form-control-sm" name="keterangan_agenda" id="keterangan_agenda"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke text-right">
            <a href="/agenda" class="btn btn-secondary btn-sm mr-1">
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
