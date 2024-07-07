@extends('admin/master')

@section('title', 'Mapel')
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
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@section('admin')
<div class="content">
@if ($errors->has('data') && $errors->first('data') == 'Data sudah ada')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Gagal : Data sudah ada.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-0">
                        <div class="col-sm-8">
                            <h2><b>Master -</b> Mapel</h2>
                        </div>
                    </div>
                    <!-- <div class="row mb-0">
                        <div class="col-sm-12">
                            <div class="search-box">
                                <i class="fa fa-search"></i>
                                <input type="text" class="form-control" placeholder="Search&hellip;">
                            </div>
                        </div>
                    </div> -->
                    <div class="row mb-0">
                        <div class="col-sm-8">
                            <a href="#add-mapel" class="btn btn-primary" data-toggle="modal"><i
                                    class="bi bi-plus"></i><span>Tambah Data</span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myDataTable" class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapels as $key => $item)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <!-- <td>{{ $item->name }}</td>
                                        <td>{{ $item->status }}</td> -->
                                        <td><a class="editable" data-name="name" data-type="text" data-pk="{{ $item->id }}"
                                                data-title="Enter Name">{{ $item->name }}</a></td>

                                        <td><a class="editable" data-name="status" data-type="select"
                                                data-pk="{{ $item->id }}" data-title="Select status"
                                                data-source='[{"value": "1", "text": "active"},{"value": "2", "text": "inactive"}]'>{{ $item->status }}</a></td>
                                        <td>
                                            <!-- <a href="#" class="view" title="View" data-toggle="tooltip"><i
                                                        class="material-icons">&#xE417;</i></a> -->
                                            <!-- <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i
                                                    class="material-icons">&#xE254;</i></a> -->
                                            <a href="#" class="delete" title="Delete" data-toggle="modal"
                                                data-target="#delete-mapel{{ $item->id }}"><i class="material-icons">&#xE872;</i></a>

                                            @include('admin.masterdata.mapel.create')
                                            @include('admin.masterdata.mapel.delete')

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- <div class="clearfix">
                            <div class="hint-text">Showing <b>10</b> out of <b>25</b> entries</div>
                            <ul class="pagination">
                                <li class="page-item disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a>
                                </li>
                                <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link">4</a></li>
                                <li class="page-item"><a href="#" class="page-link">5</a></li>
                                <li class="page-item"><a href="#" class="page-link"><i
                                            class="fa fa-angle-double-right"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $.fn.editable.defaults.mode = "inline";

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $('.editable[data-name="name"]').editable({
        url:"{{ route('admin.masterdata.mapel.edit') }}",
        type:'text',
        pk:1,
        name:'name',
        title:'Enter name'
    });

    $('.editable[data-name="status"]').editable({
        url:"{{ route('admin.masterdata.mapel.edit') }}",
        type:'select',
        pk:1,
        name:'status',
        title:'Select status',
        source: [
            {value: '1', text: 'active'},
            {value: '2', text: 'inactive'}
        ]
    });
</script>
@endsection