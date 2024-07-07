<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <<style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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
            margin-top: 5px;
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
                                        <label style="text-transform: capitalize;">Bulan : {{ $currentMonth }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-filter">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="filter-group">
                                        <label style="text-transform: capitalize;">Tahun Pelajaran : {{ $selectperiode->name }} / {{ $selectperiode->semester }}</label>
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
                                        <th>Guru</th>
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
                                            <td>{{ $jurnal->jadwal->users->name }}</td>
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