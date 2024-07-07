@extends('/guru/template')

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

    .select-wrapper {
        position: relative;
        width: 150px;
        /* Sesuaikan lebar sesuai kebutuhan Anda */
    }

    .select-wrapper select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: transparent;
        border: 1px solid #ccc;
        padding: 5px 25px 5px 10px;
        width: 100%;
        cursor: pointer;
    }

    .custom-select-arrow {
        position: absolute;
        top: calc(50% - 6px);
        /* Center vertically */
        right: 10px;
        border: solid black;
        border-width: 0 2px 2px 0;
        display: inline-block;
        padding: 3px;
        transform: rotate(45deg);
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
                                    <label>Nama : </label>
                                    <h6 style="text-transform: capitalize;">{{ Auth::user()->name ?? "-"}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-filter">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="filter-group">
                                    <label>Jabatan : </label>
                                    <h6 style="text-transform: capitalize;">{{ Auth::user()->jabatan ?? "-"}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-filter">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="filter-group">
                                    <label>Tahun Ajaran / Semester : </label>
                                    <h6 style="text-transform: capitalize;">{{ $selectperiode->name ?? "-"}} / {{ $selectperiode->semester ?? "-"}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('guru.jadwal.add') }}" method="post">
                            @csrf
                            <table id="myDataTable" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tahun Ajaran</th>
                                        <th>Hari</th>
                                        <th style="text-align: center;">Jam Ke</th>
                                        <th>Kelas</th>
                                        <th>Mapel</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwals as $key => $item)
                                        <tr>
                                            <td>{{ $item->periodes->name ?? "-"}}
                                                {{ $item->periodes->semester ?? "tidak ada data"}}
                                            </td>
                                            <td>{{ $item->hari ?? "tidak ada data"}}</td>
                                            <td style="text-align: center;">{{ $item->jampels->jam_ke ?? "tidak ada data"}}</td>
                                            <td>{{ $item->kelas->name ?? "tidak ada data"}}</td>
                                            <td>{{ $item->mapels->name ?? "tidak ada data"}}</td>
                                            <td>
                                                <input type="hidden" name="is_validation" id="is_validation"
                                                    value="invalid" />
                                                <input type="hidden" name="jadwal_id" id="jadwal_id"
                                                    value="{{ $item->id}}" />
                                                <button type="button" class="btn btn-primary submit-jurnal"
                                                    data-jadwal-id="{{ $item->id }}">Input</button>
                                                <!-- <input type="submit" name="input" id="input" class="btn btn-primary"
                                                                    value="Input" /> -->
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.submit-jurnal').click(function () {
            var jadwalId = $(this).data('jadwal-id');
            var row = $(this).closest('tr');

            var data = {
                jadwal_id: jadwalId,
                is_validation: row.find('input[name="is_validation"]').val(),
                // Tambahkan data lain yang ingin dikirim
                // name: row.find('input[name="name"]').val(),
                // materi: row.find('input[name="materi"]').val(),
                // ...
                _token: '{{ csrf_token() }}' // tambahkan CSRF token
            };

            $.ajax({
                url: '{{ route("guru.jadwal.insert") }}',
                method: 'POST',
                data: data,
                success: function (response) {
                    if (response.success) {
                        $.notify({
                            icon: 'nc-icon nc-check-2',
                            message: 'Data berhasil ditambah.'
                        }, {
                            type: 'success',
                            timer: 3000
                        });

                        // Redirect to guru.jurnal page
                        setTimeout(function () {
                            window.location.href = '{{ route("guru.jurnal") }}';
                        }, 500);
                    } else {
                        $.notify({
                            icon: 'nc-icon nc-bell-55',
                            message: 'Gagal menambahkan data.'
                        }, {
                            type: 'danger',
                            timer: 3000
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    $.notify({
                        icon: 'nc-icon nc-bell-55',
                        message: 'Data jurnal sudah ada.'
                    }, {
                        type: 'danger',
                        timer: 3000
                    });
                }
            });

        });
    });

</script>

@endsection