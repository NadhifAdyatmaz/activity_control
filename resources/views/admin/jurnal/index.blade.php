@extends('/admin/master')

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
@section('admin')
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
                    <div class="table-filter">
                        <div class="row">
                            <div class="col-sm-9">

                                <div class="filter-group">
                                    <label>Tahun Ajaran : </label>
                                    <input type="text" class="form-control"
                                        value="{{ $selectperiode->name ?? "-"}} {{ $selectperiode->semester ?? "tidak ada"}}"
                                        readonly>

                                </div>
                                <div class="filter-group">
                                    <label>Pertemuan : </label>
                                    <select class="form-control">
                                        <option>Semua</option>
                                        <option>Pertemuan 1</option>
                                        <option>Pertemuan 2</option>
                                        <option>Pertemuan 3</option>
                                        <option>Pertemuan 4</option>
                                        <option>Pertemuan 5</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label>Guru : </label>
                                    <select class="form-control">
                                        <option value="">Semua</option>
                                        @foreach ($users as $guru)
                                            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                        @endforeach
                                    </select>
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
                                <th>Pertemuan</th>
                                    <th>Tanggal_Jurnal</th>
                                    <th>Materi</th>
                                    <th>Sakit</th>
                                    <th>Izin </th>
                                    <th>Alpha </th>
                                    <th>Foto </th>
                                    <th>Catatan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jurnals as $jurnal )
                                <tr>
                                
                                <td><a class="editable" data-name="name" data-type="text" data-pk="{{ $jurnal->id}}"
                                    data-title="Enter Name">{{ $jurnal->name }}</a></td>
                                <td><a class="editable" data-name="tanggal_jurnal" data-type="text" data-pk="{{ $jurnal->tanggal_jurnal}}"
                                    data-title="Enter Name">{{ $jurnal->tanggal_jurnal }}</a></td>
                                <td><a class="editable" data-name="materi" data-type="text" data-pk="{{ $jurnal->id}}"
                                    data-title="Enter Name">{{ $jurnal->materi }}</a></td>
                                <td><a class="editable" data-name="sakit" data-type="text" data-pk="{{ $jurnal->id}}"
                                    data-title="Enter Name">{{ $jurnal->sakit }}</a></td>
                                <td><a class="editable" data-name="izin" data-type="text" data-pk="{{ $jurnal->id}}"
                                    data-title="Enter Name">{{ $jurnal->izin }}</a></td>
                                <td><a class="editable" data-name="alpha" data-type="text" data-pk="{{ $jurnal->id}}"
                                    data-title="Enter Name">{{ $jurnal->alpha }}</a></td>

                                    {{-- <td>
                                        @if ($jurnal->foto)
                                            <img src="{{ asset($jurnal->foto) }}" alt="Foto Jurnal" style="max-width: 100px;">
                                        @else
                                            <span>Tidak ada foto</span>
                                        @endif
                                    </td> --}}
                                    <td>
                                            <div style="position: relative; display: inline-block;">
                                                <img src="{{ asset($jurnal->foto) ?? '../assets/img/default-avatar.png' }}" alt="Gambar Jurnal" style="max-width: 100px; max-height: 100px;">
                                                
                                            </div>
                                        
                                    </td>
                                    <td><a class="editable" data-name="catatan" data-type="text" data-pk="{{ $jurnal->id}}"
                                        data-title="Enter Name">{{ $jurnal->catatan ?? "-"}}</a></td>
                                        <td>
                                        <input type="button" name="detail" id="detail" class="btn btn-primary"
                                            value="Detail" />
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <td>Status : Aktif</td> --}}
                        {{-- <div class="dropdown" style="margin-left: 10px;">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aktif
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button">Tidak Aktif</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="mr-2">Status:</span>
                            <div class="filter-group">
                                <select class="form-control">
                                    <option>Aktif</option>
                                    <option>Tidak Atif</option>
                                </select>
                            </div>
                        </div> --}}
                        <!-- <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary">Save</button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script> -->
@endsection