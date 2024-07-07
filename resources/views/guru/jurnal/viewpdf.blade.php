<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <style>
        .table-filter .filter-group {
            float: left;
            margin-left: 15px;
        }

        .table-filter input,
        .table-filter select {
            height: 34px;
            border-radius: 3px;
            border-color: #ddd;
            box-shadow: none;
            width: auto;
            min-width: 100px;
            /* Optional, ensures minimum size */
        }

        .filter-group select.form-control {
            width: auto;
            min-width: 110px;
            /* Optional, ensures minimum size */
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child {
            width: 130px;
        }

        table.table td a {
            color: #a0a5b1;
            display: inline-block;
            margin: 0 5px;
        }

        table.table td a.view {
            color: #03A9F4;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #E34724;
        }

        table.table td i {
            font-size: 19px;
        }

        .hint-text {
            float: left;
            margin-top: 6px;
            font-size: 95%;
        }

        .filter-group select.form-control {
            width: auto;
            min-width: 110px;
            /* Optional, ensures minimum size */
        }

        .filter-group {
            display: flex;
            align-items: center;
        }

        .filter-group label {
            margin-right: 10px;
        }

    </style> -->
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
                                <h2><b>Jurnal</b> Mengajar Harian Guru</h2>
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
                        <div class="table-filter">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="filter-group">
                                        <label style="text-transform: capitalize;">BULAN</label>
                                        <span style="margin-left: 196px;">: {{ $currentMonth }}</span>
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
                                        <th>Jadwal</th>
                                        <th>Tanggal</th>
                                        <th>Pertemuan</th>
                                        <th>Materi</th>
                                        <th>Sakit</th>
                                        <th>Izin </th>
                                        <th>Alpha </th>
                                        <!-- <th>Foto </th> -->
                                        <th>Ketuntasan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jurnals as $key => $jurnal)
                                        <tr>
                                            <td>{{ $jurnal->jadwal->hari }} - {{ $jurnal->jadwal->jampels->jam_ke }} -
                                                {{ $jurnal->jadwal->kelas->name }} - {{ $jurnal->jadwal->mapels->name }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($jurnal->tanggal_jurnal)->translatedFormat('d F Y') }}
                                            </td>
                                            <td>{{ $jurnal->name ?? 'Pertemuan' }}</td>
                                            <td>{{ $jurnal->materi ?? 'input' }}</td>
                                            <td>{{ $jurnal->sakit ?? 'input' }}</td>
                                            <td>{{ $jurnal->izin ?? 'input' }}</td>
                                            <td>{{ $jurnal->alpha ?? 'input' }}</td>
                                            <!-- <td>
                                                            <img class="border-gray" width="100" height="50"
                                                                src="{{ asset($jurnal->foto) }}" alt="...">
                                                        </td> -->
                                            <td>
                                                Tuntas
                                            </td>
                                            <td>
                                                {{ $jurnal->catatan ?? "input"}}
                                            </td>

                                        </tr>
                                    @endforeach
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