@extends('/admin/master')

@section('title', 'Jadwal')

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
                            <h2><b>Jadwal</b> Mengajar</h2>
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
                                    <select class="form-control">
                                        <option>2023</option>
                                        <option>2024</option>
                                        <option>2025</option>
                                        <option>2026</option>
                                        <option>2027</option>
                                        <option>2028</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label>Semester : </label>
                                    <select class="form-control">
                                        <option>Ganjil</option>
                                        <option>Genap</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label>Guru : </label>
                                    <select class="form-control">
                                        <option>Ghafur</option>
                                        <option>Anas</option>
                                        <option>Jakfar</option>
                                        <option>DIo</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label>Hari : </label>
                                    <select class="form-control">
                                        <option>Senin</option>
                                        <option>Selasa</option>
                                        <option>Rabu</option>
                                        <option>Kamis</option>
                                        <option>Jumat</option>
                                        <option>Sabtu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-0">
                                <a class="filter-icon" href="#add-jadwal" data-toggle="modal"><i class="fa fa-plus-square"></i> Tambah</a>
                            </div>
                            @include('admin.jadwal.create')

                            <div class="col-sm-1">
                                <a class="filter-icon" href="#"><i class="fa fa-file-excel-o"></i> Impor</a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Jamke</th>
                                    <th>Guru</th>
                                    <th>Mapel</th>
                                    <th>Kelas</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Senin</option>
                                                <option>Selasa</option>
                                                <option>Rabu</option>
                                                <option>Kamis</option>
                                                <option>Jumat</option>
                                                <option>Sabtu</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Ghafur</option>
                                                <option>Anas</option>
                                                <option>Jakfar</option>
                                                <option>DIo</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Struktur Data</option>
                                                <option>Basis Data</option>
                                                <option>UI/UX</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>X RPL 1</option>
                                                <option>X RPL 2</option>
                                                <option>X DKV 1</option>
                                                <option>X DKV 2</option>
                                            </select>
                                        </div>
                                    </td>

                                    <td>
                                        <!-- <a href="#" class="view" title="View" data-toggle="tooltip"><i
                                                class="material-icons">&#xE417;</i></a>
                                        <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i
                                                class="material-icons">&#xE254;</i></a> -->
                                        <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i
                                                class="material-icons">&#xE872;</i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Senin</option>
                                                <option>Selasa</option>
                                                <option>Rabu</option>
                                                <option>Kamis</option>
                                                <option>Jumat</option>
                                                <option>Sabtu</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Ghafur</option>
                                                <option>Anas</option>
                                                <option>Jakfar</option>
                                                <option>DIo</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Struktur Data</option>
                                                <option>Basis Data</option>
                                                <option>UI/UX</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>X RPL 1</option>
                                                <option>X RPL 2</option>
                                                <option>X DKV 1</option>
                                                <option>X DKV 2</option>
                                            </select>
                                        </div>
                                    </td>

                                    <td>
                                        <!-- <a href="#" class="view" title="View" data-toggle="tooltip"><i
                                                class="material-icons">&#xE417;</i></a>
                                        <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i
                                                class="material-icons">&#xE254;</i></a> -->
                                        <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i
                                                class="material-icons">&#xE872;</i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Senin</option>
                                                <option>Selasa</option>
                                                <option>Rabu</option>
                                                <option>Kamis</option>
                                                <option>Jumat</option>
                                                <option>Sabtu</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Ghafur</option>
                                                <option>Anas</option>
                                                <option>Jakfar</option>
                                                <option>DIo</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Struktur Data</option>
                                                <option>Basis Data</option>
                                                <option>UI/UX</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>X RPL 1</option>
                                                <option>X RPL 2</option>
                                                <option>X DKV 1</option>
                                                <option>X DKV 2</option>
                                            </select>
                                        </div>
                                    </td>

                                    <td>
                                        <!-- <a href="#" class="view" title="View" data-toggle="tooltip"><i
                                                class="material-icons">&#xE417;</i></a>
                                        <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i
                                                class="material-icons">&#xE254;</i></a> -->
                                        <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i
                                                class="material-icons">&#xE872;</i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Senin</option>
                                                <option>Selasa</option>
                                                <option>Rabu</option>
                                                <option>Kamis</option>
                                                <option>Jumat</option>
                                                <option>Sabtu</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Ghafur</option>
                                                <option>Anas</option>
                                                <option>Jakfar</option>
                                                <option>DIo</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Struktur Data</option>
                                                <option>Basis Data</option>
                                                <option>UI/UX</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>X RPL 1</option>
                                                <option>X RPL 2</option>
                                                <option>X DKV 1</option>
                                                <option>X DKV 2</option>
                                            </select>
                                        </div>
                                    </td>

                                    <td>
                                        <!-- <a href="#" class="view" title="View" data-toggle="tooltip"><i
                                                class="material-icons">&#xE417;</i></a>
                                        <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i
                                                class="material-icons">&#xE254;</i></a> -->
                                        <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i
                                                class="material-icons">&#xE872;</i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Senin</option>
                                                <option>Selasa</option>
                                                <option>Rabu</option>
                                                <option>Kamis</option>
                                                <option>Jumat</option>
                                                <option>Sabtu</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Ghafur</option>
                                                <option>Anas</option>
                                                <option>Jakfar</option>
                                                <option>DIo</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Struktur Data</option>
                                                <option>Basis Data</option>
                                                <option>UI/UX</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>X RPL 1</option>
                                                <option>X RPL 2</option>
                                                <option>X DKV 1</option>
                                                <option>X DKV 2</option>
                                            </select>
                                        </div>
                                    </td>

                                    <td>
                                        <!-- <a href="#" class="view" title="View" data-toggle="tooltip"><i
                                                class="material-icons">&#xE417;</i></a>
                                        <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i
                                                class="material-icons">&#xE254;</i></a> -->
                                        <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i
                                                class="material-icons">&#xE872;</i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Senin</option>
                                                <option>Selasa</option>
                                                <option>Rabu</option>
                                                <option>Kamis</option>
                                                <option>Jumat</option>
                                                <option>Sabtu</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Ghafur</option>
                                                <option>Anas</option>
                                                <option>Jakfar</option>
                                                <option>DIo</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>Struktur Data</option>
                                                <option>Basis Data</option>
                                                <option>UI/UX</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="filter-group">
                                            <select class="form-control">
                                                <option>X RPL 1</option>
                                                <option>X RPL 2</option>
                                                <option>X DKV 1</option>
                                                <option>X DKV 2</option>
                                            </select>
                                        </div>
                                    </td>

                                    <td>
                                        <!-- <a href="#" class="view" title="View" data-toggle="tooltip"><i
                                                class="material-icons">&#xE417;</i></a>
                                        <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i
                                                class="material-icons">&#xE254;</i></a> -->
                                        <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i
                                                class="material-icons">&#xE872;</i></a>
                                    </td>
                                </tr>

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
                        </div> --}}
                        <div class="d-flex align-items-center">
                            <span class="mr-2">Status:</span>
                            <div class="filter-group">
                                <select class="form-control">
                                    <option>Aktif</option>
                                    <option>Tidak Atif</option>
                                </select>
                            </div>
                        </div>
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