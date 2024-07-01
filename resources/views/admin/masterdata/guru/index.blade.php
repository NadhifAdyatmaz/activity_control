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

    .text-truncate {
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
                    <div class="row mb-0">
                        <div class="col-sm-12 text-center">
                            <h2><b>Master -</b> Guru</h2>
                        </div>
                    </div>
                </div>
                <div class="container mt-5 mb-5">
                    <div class="row g-2">
                        @foreach($gurus as $guru)
                            <div class="col-md-3">
                                <div class="card p-3 mb-4 text-center">
                                    <div class="img mb-2">
                                        <img src="{{ $guru->photo ? asset($guru->photo) : asset('assets/img/default-avatar.png') }}"
                                            width="70" class="rounded-circle">
                                    </div>
                                    <h5>{{ $guru->name }}</h5>
                                    <p class="text-muted">{{ $guru->username ?? "username"}} <span>| </span><span><a
                                                class="text-pink text-truncate">{{ $guru->email }}</a></span></p>
                                    <!-- <p class="jabatan bg-yellow-300">{{ $guru->jabatan }}</p> -->
                                    <div class="mt-4 apointment">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#detail-guru{{ $guru->id }}">Detail</button>
                                    </div>
                                    @include('admin.masterdata.guru.detailguru')
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection