@extends('admin/master')

@section('title', 'Guru')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<style>
    @import url('https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap');

    body {
        font-family: 'Maven Pro', sans-serif
    }

    body {
        background-color: #eee
    }

    .add {
        border-radius: 20px
    }

    .card {
        border: none;
        border-radius: 10px;
        transition: all 1s;
        cursor: pointer
    }

    .card:hover {
        -webkit-box-shadow: 3px 5px 17px -4px #777777;
        box-shadow: 3px 5px 17px -4px #777777
    }

    .ratings i {
        color: green
    }

    .apointment button {
        border-radius: 20px;
        background-color: #eee;
        color: #000;
        border-color: #eee;
        font-size: 13px
    }

    .text-truncate-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
        /* Adjust the max-width as per your requirement */
        display: inline-block;
        vertical-align: middle;
    }

    .text-truncate-email {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 120px;
        /* Adjust the max-width as per your requirement */
        display: inline-block;
        vertical-align: middle;
    }


    /* .jabatan {
    background-color: #efef09;
    padding: 5px;
    border-radius: 5px;
    display: inline-block;
    margin-top: 5px;
} */
</style>

@section('admin')
<div class="content">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <div class="row mb-0">
                        <div class="col-sm-12 text-center">
                            <h2><b>Daftar -</b> User</h2>
                        </div>
                    </div> -->
                    <div class="row mb-0 text-center">
                        <div class="col-sm-2">
                            <a href="#add-guru" class="btn btn-secondary" data-toggle="modal"><i
                                    class="bi bi-plus"></i><span>Tambah Data</span></a>
                        </div>
                        <div class="col-sm-0">
                            <a href="#import-guru" class="btn btn-success" data-toggle="modal"><i
                                    class="bi bi-plus"></i><span>Import Data</span></a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container mt-1 mb-1">
                    <div class="row mb-0 justify-content-center">
                        <div class="col-sm-12 text-center">
                            <h2>Kepala Sekolah</h2>
                        </div>
                    </div>
                    <div class="row g-2 justify-content-center">
                        @foreach($gurus as $guru)
                            @if ($guru->role == 'kepsek')
                                <div class="col-md-3">
                                    <div class="card p-3 mb-4 text-center">
                                        <div class="img mb-2">
                                            <img src="{{ $guru->photo ? asset($guru->photo) : asset('assets/img/default-avatar.png') }}"
                                                width="70" class="rounded-circle">
                                        </div>
                                        <h5 class="text-truncate-name">{{ $guru->name }}</h5>
                                        <p class="text-muted">{{ $guru->jabatan ?? "Guru" }}</p>
                                        <div class="mt-4 apointment">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#detail-guru{{ $guru->id }}">Detail</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <hr>
                <div class="container mt-1 mb-5">
                    <div class="row mb-0">
                        <div class="col-sm-12 text-center">
                            <h2>Guru</h2>
                        </div>
                    </div>
                    <div class="row g-2">
                        @foreach($gurus as $guru)
                            @if ($guru->role == 'guru')
                                <div class="col-md-3">
                                    <div class="card p-3 mb-4 text-center">
                                        <div class="img mb-2">
                                            <img src="{{ $guru->photo ? asset($guru->photo) : asset('assets/img/default-avatar.png') }}"
                                                width="70" class="rounded-circle">
                                        </div>
                                        <h5 class="text-truncate-name">{{ $guru->name }}</h5>
                                        <!-- <p class="text-muted">{{ $guru->username ?? "username"}} <span>| </span><span><a
                                                            class="text-pink text-truncate-email">{{ $guru->email }}</a></span></p> -->
                                        <p class="text-muted">{{ $guru->jabatan ?? "Guru"}}</p>
                                        <div class="mt-4 apointment">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#detail-guru{{ $guru->id }}">Detail</button>
                                        </div>
                                        @include('admin.masterdata.guru.detailguru')
                                        @include('admin.masterdata.guru.add')
                                        @include('admin.masterdata.guru.import')
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection