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
        padding-top: 6px
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
                    <div class="col-sm-12" style="text-align: center;">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tahun Ajaran
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button">2022 - 2023</button>
                            <button class="dropdown-item" type="button"> 2023 - 2024</button>
                            <button class="dropdown-item" type="button">2024 - 2025</button>
                        </div>
                    </div>
                    <div class="" col-sm-12" style="text-align: center;"">
                    <button class=" btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Semester
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button">Genap</button>
                            <button class="dropdown-item" type="button">Ganjil</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row justify-content-end"> <!-- Align the row content to the right -->
                            <div class="col-sm-1 offset-sm-11" style="text-align: center;">
                                <!-- Adjust offset and column width -->
                                <div class="button-action d-flex justify-content-end" style="margin-bottom: 20px">
                                    <button type="button" class="btn btn-success mr-14" data-toggle="modal"
                                        data-target="#import">
                                        IMPORT
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" id="classDropdown1" data-toggle="dropdown"
                                                aria-haspopup="false" aria-expanded="true">
                                                Senin
                                            </div>
                                            <div class="dropdown-menu" aria-labelledby="classDropdown1">
                                                <button class="dropdown-item" type="button">Senin</button>
                                                <button class="dropdown-item" type="button">Selasa</button>
                                                <button class="dropdown-item" type="button">Rabu</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" id="classDropdown1" data-toggle="dropdown"
                                                aria-haspopup="false" aria-expanded="true">
                                                1
                                            </div>
                                            <div class="dropdown-menu" aria-labelledby="classDropdown1">
                                                <button class="dropdown-item" type="button">1</button>
                                                <button class="dropdown-item" type="button">2</button>
                                                <button class="dropdown-item" type="button">3</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" id="classDropdown1" data-toggle="dropdown"
                                                aria-haspopup="false" aria-expanded="true">
                                                Anas Aminulloh T.H
                                            </div>
                                            <div class="dropdown-menu" aria-labelledby="classDropdown1">
                                                <button class="dropdown-item" type="button">Class A</button>
                                                <button class="dropdown-item" type="button">Class B</button>
                                                <button class="dropdown-item" type="button">Class C</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" id="classDropdown1" data-toggle="dropdown"
                                                aria-haspopup="false" aria-expanded="true">
                                                Desain Grafis
                                            </div>
                                            <div class="dropdown-menu" aria-labelledby="classDropdown1">
                                                <button class="dropdown-item" type="button">Class A</button>
                                                <button class="dropdown-item" type="button">Class B</button>
                                                <button class="dropdown-item" type="button">Class C</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" id="classDropdown1" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                X RPL 1
                                            </div>
                                            <div class="dropdown-menu" aria-labelledby="classDropdown1">
                                                <button class="dropdown-item" type="button">Class A</button>
                                                <button class="dropdown-item" type="button">Class B</button>
                                                <button class="dropdown-item" type="button">Class C</button>
                                            </div>
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
                        <div class="btn-group">
                            <button type="button" class="btn btn-Success dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Aktif
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Tidak Aktif</a>
                            </div>
                        </div>
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