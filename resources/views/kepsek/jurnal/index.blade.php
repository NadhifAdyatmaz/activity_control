@extends('/kepsek/master')

@section('title', 'Jurnal')

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    body {
        color: #566787;
        background: #f5f5f5;
        font-family: 'Roboto', sans-serif;
    }

    .table-responsive {
        margin: 30px 0;
    }

    .table-wrapper {
        min-width: 1000px;
        background: #fff;
        padding: 20px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
        min-width: 100%;
    }

    .table-title h2 {
        margin: 8px 0 0;
        font-size: 22px;
    }

    .search-box {
        position: relative;
        float: right;
    }

    .search-box input {
        height: 34px;
        border-radius: 20px;
        padding-left: 35px;
        border-color: #ddd;
        box-shadow: none;
    }

    .search-box input:focus {
        border-color: #3FBAE4;
    }

    .search-box i {
        color: #a0a5b1;
        position: absolute;
        font-size: 19px;
        top: 8px;
        left: 10px;
    }

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

    .table-filter {
        padding: 5px 0 15px;
        border-bottom: 1px solid #e9e9e9;
        margin-bottom: 5px;
    }

    .table-filter .btn {
        height: 34px;
    }

    .table-filter label {
        font-weight: normal;
        margin-left: 10px;
    }

    .table-filter select,
    .table-filter input {
        display: inline-block;
        margin-left: 5px;
    }

    .filter-group select.form-control {
        width: auto;
        min-width: 110px;
        /* Optional, ensures minimum size */
    }

    .filter-icon {
        float: right;
        margin-top: 7px;
    }

    .filter-icon i {
        font-size: 18px;
        opacity: 0.7;
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

    .pagination {
        float: right;
        margin: 0 0 5px;
    }

    .pagination li a {
        border: none;
        font-size: 95%;
        width: 30px;
        height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 30px !important;
        text-align: center;
        padding: 0;
    }

    .pagination li a:hover {
        color: #666;
    }

    .pagination li.active a {
        background: #03A9F4;
    }

    .pagination li.active a:hover {
        background: #0397d6;
    }

    .pagination li.disabled i {
        color: #ccc;
    }

    .pagination li i {
        font-size: 16px;
        padding-top: 6px;
    }

    .hint-text {
        float: left;
        margin-top: 6px;
        font-size: 95%;
    }
</style>
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12" style="text-align: center;">
                            <h2><b>Jurnal</b> Mengajar</h2>
                        </div>
                        <div class="col-sm-4">
                            {{-- <div class="search-box">
                                <i class="fa fa-search"></i>
                                <input type="text" class="form-control" placeholder="Search&hellip;">
                            </div> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-center align-items-center">
                            <label style="margin-right: 10px;">Tahun Ajaran : </label>
                            <h6 style="text-transform: capitalize;">{{ $selectperiode->name ?? "-" }}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-center align-items-center">
                            <label style="margin-right: 10px;">Semester : </label>
                            <h6 style="text-transform: capitalize;">{{ $selectperiode->semester ?? "-" }}</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <a href="#" title="ViewPdf" data-toggle="modal" data-target="#view-pdf"
                        class="btn btn-danger">Lihat/ Unduh PDF</a>
                    <div class="table-responsive">
                        <table id="myDataTable" class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Jadwal</th>
                                    <th>Tanggal</th>
                                    <th>Guru</th>
                                    <th>Pertemuan</th>
                                    <th>Materi</th>
                                    <th>Sakit</th>
                                    <th>Izin </th>
                                    <th>Alpha </th>
                                    <th>Foto </th>
                                    <th>Catatan</th>
                                    <th>Status</th>
                                    <th style="text-align: center;">TTD</th>
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jurnals as $key => $item)
                                    <tr>
                                        <td>
                                            {{ $item->jadwal->hari}}-{{ $item->jadwal->jampels->jam_ke}}-{{ $item->jadwal->kelas->name}}-{{ $item->jadwal->mapels->name}}
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_jurnal)) ?? "tidak ada data"}}</td>
                                        <td>{{ $item->jadwal->users->name}}</td>
                                        <td>{{ $item->name ?? "tidak ada data"}}</td>
                                        <td>{{ $item->materi ?? "tidak ada data"}}</td>
                                        <td style="text-align: center;">{{ $item->sakit ?? "tidak ada data"}}</td>
                                        <td style="text-align: center;">{{ $item->izin ?? "tidak ada data"}}</td>
                                        <td style="text-align: center;">{{ $item->alpha ?? "tidak ada data"}}</td>
                                        <td style="text-align: center;"><img class="border-gray" width="100" height="50"
                                                src="{{ $item->foto ? asset($item->foto) : asset('assets/img/noimg.png') }}"
                                                alt="..."></td>
                                        <td>{{ $item->catatan ?? "tidak ada data"}}</td>
                                        <td>@if ($item->is_validation == null && $item->is_validation->isNotEmpty())
                                            tidak ada data
                                        @elseif ($item->is_validation == "invalid")
                                            Tidak Tuntas
                                        @else
                                            Tuntas
                                        @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <img class="border-gray" width="100" height="50"
                                                src="{{ $item->ttd ? asset($item->ttd) : asset('assets/img/noimg.png') }}"
                                                alt="...">
                                        </td>
                                        <!-- <td>
                                                <input type="button" name="detail" id="detail" class="btn btn-primary"
                                                value="Detail" />
                                                </td> -->
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

<div id="view-pdf" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lihat PDF</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form action="{{ route('kepsek.jurnal.viewpdf') }}" method="get" id="view-pdf-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="filter">Filter Tanggal</label>
                        <select id="filter" name="filter" class="form-control">
                            <option value="today">Hari Ini</option>
                            <option value="this_week">Minggu Ini</option>
                            <option value="this_month">Bulan Ini</option>
                            <option value="custom">Pilih Tanggal</option>
                        </select>
                    </div>
                    <div class="form-group" id="custom-date-group" style="display: none;">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" class="form-control">
                        <label for="end_date">Tanggal Selesai</label>
                        <input type="date" id="end_date" name="end_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="teacher">Nama Guru</label>
                        <select id="teacher" name="teacher" class="form-control">
                            <option value="all">Semua Guru</option>
                            @foreach ($users as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <button type="submit" name="action" value="view" class="btn btn-primary" id="view-pdf-btn">Lihat
                        PDF</button>
                    <button type="submit" name="action" value="download" class="btn btn-danger">Unduh PDF</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filter = document.getElementById('filter');
        const customDateGroup = document.getElementById('custom-date-group');
        const viewPdfForm = document.getElementById('view-pdf-form');
        const viewPdfBtn = document.getElementById('view-pdf-btn');

        filter.addEventListener('change', function() {
            if (this.value === 'custom') {
                customDateGroup.style.display = 'block';
            } else {
                customDateGroup.style.display = 'none';
            }
        });

        viewPdfBtn.addEventListener('click', function() {
            viewPdfForm.setAttribute('target', '_blank');
        });
    });
</script>

@endsection