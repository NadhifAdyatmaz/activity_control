@extends('admin/master')

@section('title', 'Guru')

<link href="assets/css/masterguru.css" rel="stylesheet" type="text/css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

@section('admin')
<div class="content">
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
                            <div class="card p-2 py-3 text-center">
                                <div class="img mb-2">
                                    <img src="{{ $guru->profile_picture_url ?? '../assets/img/default-avatar.png' }}" width="70" class="rounded-circle">
                                </div>
                                <h5>{{ $guru->name }}</h5>
                                <p class="text-muted">{{ $guru->username }} <span>| </span><span><a href="#" class="text-pink">{{ $guru->email }}</a></span></p>
                                <!-- <p class="jabatan bg-yellow-300">{{ $guru->jabatan }}</p> -->
                                <div class="mt-4 apointment">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail-guru{{ $guru->id }}">Detail</button>
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
