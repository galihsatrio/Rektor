@extends('layout.master')

@section('title', 'Dashboard')
@section('header-content')
    <h1 class="judul-page">Dashboard</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
    </div>
@endsection

@section('header-body')
    <div class="card">
        <div class="card-header">
            <h4>Dashboard</h4>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-6">
                    <h5 class="mb-5 text-primary">Grafik Agenda Pertemuan Dalam 1 Minggu Kedepan</h5>
                    <canvas id="chartAgenda" width="100%" ></canvas>
                </div>
                <div class="col-6">
                    <h5 class="mb-5 text-primary">Grafik Mahasiswa</h5>
                    <canvas id="chartMahasiswa" width="100%" ></canvas>
                </div>
                @if (isset($array['gedung']))
                <div class="col-6 pt-5 px-5">
                    <h5 class="mb-4 text-primary">Grafik Asset Berdasarkan Gedung</h5>
                    <canvas id="chartGedung" width="100%" ></canvas>
                </div>
                @endif
                @if (isset($array['kategori']))
                <div class="col-6 pt-5 px-5">
                    <h5 class="mb-4 text-primary">Grafik Asset Berdasarkan Kategori</h5>
                    <canvas id="chartKategori" width="100%" ></canvas>
                </div>
                @endif
                @if(isset($array['unit']))
                <div class="col-6 pt-5 px-5">
                    <h5 class="mb-4 text-primary">Grafik Asset Berdasarkan Unit</h5>
                    <canvas id="chartUnit" width="100%" ></canvas>
                </div>
                @endif
                @if (!empty($asset))
                <div class="col-12 pt-5">
                    <h5 class="mb-4 text-primary">Data Asset</h5>
                    <table class="table table-striped table-md">
                        <tbody>
                            <tr class="text-center bg-primary text-white">
                                <th>Kode</th>
                                <th>Jenis</th>
                                <th>Tipe</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Penyimpanan</th>
                                <th>Status</th>
                                <th>Unit</th>
                                <th>Kategori</th>
                                <th>Gedung</th>
                            </tr>
                            @foreach ( $asset as $value )
                            <tr class="text-center">
                                <td class="text-left">{{ $value->kodeAset }}</td>
                                <td>{{ $value->jenisBarang }}</td>
                                <td>{{ $value->tipeBarang }}</td>
                                <td>{{ $value->jumlahBarang }}</td>
                                <td>{{ $value->tglBeli }}</td>
                                <td>{{ $value->penyimpanan }}</td>
                                <td>{{ $value->status }}</td>
                                <td>{{ $value->unit }}</td>
                                <td>{{ $value->kategori }}</td>
                                <td>{{ $value->gedung }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
        <div class="card-footer bg-whitesmoke text-right">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">

        var data = <?php echo $data; ?>;
            agenda = data.agenda;
            dataMahasiswa = data.mahasiswa;
            dataGedung = typeof data.gedung !== 'undefined' ? data.gedung : [];
            dataKategori = typeof data.kategori !== 'undefined' ? data.kategori : [];
            dataUnit = typeof data.unit !== 'undefined' ? data.unit : [];

            hari = [];
            nilai_agenda = [];
            mahasiswa = [];

        agenda.forEach(element => {
            hari.push(element.hari);
            nilai_agenda.push(element.total_agenda);
        });

        dataMahasiswa.forEach(element => {
            mahasiswa.push(element.total_mahasiswa);
        });


        var lineChart = document.getElementById('chartAgenda');
        var chartAgenda = new Chart(lineChart, {
            type: 'line',
            data: {
                labels: hari,
                datasets: [{
                    label: 'Agenda',
                    data: nilai_agenda,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var barChart = document.getElementById('chartMahasiswa');
        var chartMahasiswa = new Chart(barChart, {
            type: 'bar',
            data: {
                labels: [2016, 2017, 2018, 2019, 2020, 2021, 2022],
                datasets: [{
                    label: 'Mahasiswa',
                    data: mahasiswa,
                    backgroundColor: [
                        '#fc3903',
                        '#0352fc',
                        '#fcca03',
                        '#03b1fc',
                        '#18fc03',
                        '#fc9003'
                    ],
                    borderColor: [
                        '#fc3903',
                        '#0352fc',
                        '#fcca03',
                        '#03b1fc',
                        '#18fc03',
                        '#fc9003'
                    ],
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        if (dataGedung) {
            var chartGedung = document.getElementById('chartGedung');
            var gedung = new Chart(chartGedung, {
                type: 'doughnut',
                data: {
                    labels: [dataGedung[0].nama, dataGedung[1].nama, dataGedung[2].nama, dataGedung[3].nama, dataGedung[4].nama, dataGedung[5].nama ],
                    datasets: [{
                        label: 'Gedung',
                        data: [
                            dataGedung[0].total_aset == undefined ? 0 : dataGedung[0].total_aset,
                            dataGedung[1].total_aset == undefined ? 0 : dataGedung[1].total_aset,
                            dataGedung[2].total_aset == undefined ? 0 : dataGedung[2].total_aset,
                            dataGedung[3].total_aset == undefined ? 0 : dataGedung[3].total_aset,
                            dataGedung[4].total_aset == undefined ? 0 : dataGedung[4].total_aset,
                            dataGedung[5].total_aset == undefined ? 0 : dataGedung[5].total_aset
                        ],
                        backgroundColor: [
                            '#fc3903',
                            '#0352fc',
                            '#fcca03',
                            '#03b1fc',
                            '#18fc03',
                            '#fc9003'
                        ],
                        borderColor: [
                            '#fc3903',
                            '#0352fc',
                            '#fcca03',
                            '#03b1fc',
                            '#18fc03',
                            '#fc9003'
                        ],
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        if (dataKategori) {
            var chartKategori = document.getElementById('chartKategori');
            var kategori = new Chart(chartKategori, {
                type: 'doughnut',
                data: {
                    labels: [
                        dataKategori[0].nama,
                        dataKategori[1].nama,
                        dataKategori[2].nama,
                        dataKategori[3].nama,
                        dataKategori[4].nama,
                    ],
                    datasets: [{
                        label: 'Kategori',
                        data: [
                            dataKategori[0].total_aset == undefined ? 0 : dataKategori[0].total_aset,
                            dataKategori[1].total_aset == undefined ? 0 : dataKategori[1].total_aset,
                            dataKategori[2].total_aset == undefined ? 0 : dataKategori[2].total_aset,
                            dataKategori[3].total_aset == undefined ? 0 : dataKategori[3].total_aset,
                            dataKategori[4].total_aset == undefined ? 0 : dataKategori[4].total_aset,
                        ],
                        backgroundColor: [
                            '#fc3903',
                            '#0352fc',
                            '#fcca03',
                            '#03b1fc',
                            '#18fc03',
                            '#fc9003'
                        ],
                        borderColor: [
                            '#fc3903',
                            '#0352fc',
                            '#fcca03',
                            '#03b1fc',
                            '#18fc03',
                            '#fc9003'
                        ],
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        if (dataUnit) {
            var chartUnit = document.getElementById('chartUnit');
            var unit = new Chart(chartUnit, {
                type: 'doughnut',
                data: {
                    labels: [
                        dataUnit[0].nama,
                        dataUnit[1].nama,
                        dataUnit[2].nama,
                        dataUnit[3].nama,
                        dataUnit[4].nama,
                        dataUnit[5].nama,
                        dataUnit[6].nama,
                        dataUnit[7].nama,
                        dataUnit[8].nama,
                        dataUnit[9].nama,
                    ],
                    datasets: [{
                        label: 'Kategori',
                        data: [
                            dataUnit[0].total_aset == undefined ? 0 : dataUnit[0].total_aset,
                            dataUnit[1].total_aset == undefined ? 0 : dataUnit[1].total_aset,
                            dataUnit[2].total_aset == undefined ? 0 : dataUnit[2].total_aset,
                            dataUnit[3].total_aset == undefined ? 0 : dataUnit[3].total_aset,
                            dataUnit[4].total_aset == undefined ? 0 : dataUnit[4].total_aset,
                            dataUnit[5].total_aset == undefined ? 0 : dataUnit[5].total_aset,
                            dataUnit[6].total_aset == undefined ? 0 : dataUnit[6].total_aset,
                            dataUnit[7].total_aset == undefined ? 0 : dataUnit[7].total_aset,
                            dataUnit[8].total_aset == undefined ? 0 : dataUnit[8].total_aset,
                            dataUnit[9].total_aset == undefined ? 0 : dataUnit[9].total_aset,
                        ],
                        backgroundColor: [
                            '#fc3903',
                            '#0352fc',
                            '#fcca03',
                            '#03b1fc',
                            '#18fc03',
                            '#fc9003',
                            '#2c718f',
                            '#350887',
                            '#75c712',
                            '#c71251'
                        ],
                        borderColor: [
                            '#fc3903',
                            '#0352fc',
                            '#fcca03',
                            '#03b1fc',
                            '#18fc03',
                            '#fc9003',
                            '#2c718f',
                            '#350887',
                            '#75c712',
                            '#c71251'
                        ],
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }



    </script>
@endsection
