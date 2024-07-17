<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        h2,
        h3 {
            margin: 10px;
            padding: 0;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .card-header {
            margin-bottom: 5px;
        }

        .table-filter .filter-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .table-filter .filter-group label {
            min-width: 200px;
            /* Adjust this value as needed */
        }

        .table-filter .filter-group span {
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12" style="text-align: center;">
                                <h2><b>Jadwal</b> Mengajar Harian Guru</h2>
                                @foreach ($infos as $info)
                                    <h3><b>{{$info->sekolah}}</b></h3>
                                @endforeach
                            </div>
                        </div>
                        <div class="table-filter">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="filter-group">
                                        <label>NAMA</label>
                                        <span style="margin-left: 202px; text-transform: capitalize;">:
                                            {{ Auth::user()->name ?? "-"}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-filter">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="filter-group">
                                        <label>JABATAN</label>
                                        <span style="margin-left: 178px;text-transform: capitalize;">:
                                            {{ Auth::user()->jabatan ?? "-"}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-filter">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="filter-group">
                                        <label>TAHUN PELAJARAN / SEMESTER</label>
                                        <span style="margin-left: 5px;text-transform: capitalize;">:
                                            {{ $selectperiode->name ?? "-"}} /
                                            {{ $selectperiode->semester ?? "-"}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myDataTable" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tahun Ajaran</th>
                                        <th>Hari</th>
                                        <th style="text-align: center;">Jam Ke</th>
                                        <th>Kelas</th>
                                        <th>Mapel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jadwals as $key => $item)
                                        <tr>
                                            <td>{{ $item->periodes->name ?? "-"}}
                                                {{ $item->periodes->semester ?? "tidak ada data"}}
                                            </td>
                                            <td>{{ $item->hari ?? "tidak ada data"}}</td>
                                            <td style="text-align: center;">{{ $item->jampels->jam_ke ?? "tidak ada data"}}
                                            </td>
                                            <td>{{ $item->kelas->name ?? "tidak ada data"}}</td>
                                            <td>{{ $item->mapels->name ?? "tidak ada data"}}</td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align: center;">Tidak Ada Data Jurnal</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>