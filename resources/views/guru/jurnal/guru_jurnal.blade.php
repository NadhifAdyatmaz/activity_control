@extends('guru/template')

@section('title', 'jurnal')

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css"> -->
<style>
    /* Additional Styles */
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
                            <h2><b>Jurnal</b> Mengajar</h2>
                        </div>
                        <!-- <div class="col-sm-4">
                            <div class="search-box">
                                <i class="fa fa-search"></i>
                                <input type="text" class="form-control" placeholder="Search&hellip;">
                            </div>
                        </div> -->
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
                                    <h6 style="text-transform: capitalize;">{{ $selectperiode->name ?? "-"}} /
                                        {{ $selectperiode->semester ?? "-"}}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <a href="#" title="ViewPdf" data-toggle="modal" data-target="#view-pdf"
                        class="btn btn-danger">Lihat / Unduh PDF</a>
                    <div class="table-responsive">
                        <table id="myDataTable" class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Jadwal</th>
                                    <th>Tanggal</th>
                                    <th>Pertemuan</th>
                                    <th>Materi</th>
                                    <th>Sakit</th>
                                    <th>Izin </th>
                                    <th>Alpha </th>
                                    <th>Foto </th>
                                    <th>Catatan</th>
                                    <th>Status</th>
                                    <th>TTD</th>
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jurnals as $key => $item)
                                    <tr>
                                        <td>
                                            {{ $item->jadwal->hari}}-{{ $item->jadwal->jampels->jam_ke}}-{{ $item->jadwal->kelas->name}}-{{ $item->jadwal->mapels->name}}
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_jurnal)) ?? "DD/MM/YYYY"}}</td>
                                        <td>{{ $item->name ?? "Pertemuan"}}</td>
                                        <td>@if ($item->is_validation == "invalid")
                                            <a class="editable" data-name="materi" data-type="text"
                                                data-pk="{{ $item->id }}"
                                                data-title="input materi">{{ $item->materi ?? "klik 1x"}}</a>
                                        @else
                                            {{ $item->materi ?? "input"}}
                                        @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if ($item->is_validation == "invalid")
                                                <a class="editable" data-name="sakit" data-type="number" min="0"
                                                    data-pk="{{ $item->id }}"
                                                    data-title="input sakit">{{ $item->sakit ?? "klik 1x"}}</a>
                                            @else
                                                {{ $item->sakit ?? "input"}}
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if ($item->is_validation == "invalid")
                                                <a class="editable" data-name="izin" data-type="number" min="0"
                                                    data-pk="{{ $item->id }}"
                                                    data-title="input izin">{{ $item->izin ?? "klik 1x"}}</a>
                                            @else
                                                {{ $item->izin ?? "input"}}
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if ($item->is_validation == "invalid")
                                                <a class="editable" data-name="alpha" data-type="number" min="0"
                                                    data-pk="{{ $item->id }}"
                                                    data-title="input alpha">{{ $item->alpha ?? "klik 1x"}}</a>
                                            @else
                                                {{ $item->alpha ?? "input"}}
                                            @endif
                                        </td>

                                        {{-- <td>
                                            @if ($item->foto)
                                            <img src="{{ asset($item->foto) }}" alt="Foto item" style="max-width: 100px;">
                                            @else
                                            <span>Tidak ada foto</span>
                                            @endif
                                        </td> --}}
                                        <td style="text-align: center;">
                                            @if ($item->is_validation == "invalid")
                                                @if ($item->foto)
                                                    <a href="#" class="foto" title="foto" data-toggle="modal"
                                                        data-target="#foto{{$item->id}}">
                                                        <img class="border-gray" width="100" height="50"
                                                            src="{{ $item->foto ? asset($item->foto) : asset('assets/img/noimg.png') }}"
                                                            alt="...">
                                                    </a>
                                                @else
                                                    <a href="#" class="foto" title="foto" data-toggle="modal"
                                                        data-target="#foto{{$item->id}}"><i
                                                            class=" material-icons">add_a_photo</i></a>

                                                @endif  
                                            @else
                                                <img class="border-gray" width="100" height="50"
                                                    src="{{ $item->foto ? asset($item->foto) : asset('assets/img/noimg.png') }}"
                                                    alt="...">
                                            @endif

                                        </td>
                                        <td>
                                            @if ($item->is_validation == "invalid")
                                                <a class="editable" data-name="catatan" data-type="textarea" rows="2"
                                                    data-pk="{{ $item->id }}"
                                                    data-title="input catatan">{{ $item->catatan ?? "klik 1x"}}</a>
                                            @else
                                                {{ $item->catatan ?? "input"}}
                                            @endif

                                        </td>
                                        <td>@if ($item->is_validation == null && empty($item->is_validation))
                                            tidak ada data
                                        @elseif ($item->is_validation == "invalid")
                                            Tidak Tuntas
                                        @else
                                            Tuntas
                                        @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if ($item->is_validation == "invalid")
                                                @if ($item->ttd)
                                                    <a href="#" class="ttd" title="ttd" data-toggle="modal"
                                                        data-target="#ttd{{$item->id}}">
                                                        <img class="border-gray" width="100" height="50"
                                                            src="{{ $item->ttd ? asset($item->ttd) : asset('assets/img/noimg.png') }}"
                                                            alt="...">
                                                    </a>

                                                @else
                                                    <a href="#" class="ttd" title="ttd" data-toggle="modal"
                                                        data-target="#ttd{{$item->id}}"><i class=" material-icons">&#xE254;</i></a>

                                                @endif
                                            @else
                                                <img class="border-gray" width="100" height="50"
                                                    src="{{ $item->ttd ? asset($item->ttd) : asset('assets/img/noimg.png') }}"
                                                    alt="...">
                                            @endif

                                        </td>
                                        {{-- <td style="text-align: center;">
                                            <!-- <a href="#" class="view" title="View" data-toggle="modal"
                                                                                    data-target="#view-jur"><i class=" material-icons">&#xE417;</i></a> -->
                                            <a href="#" class="delete" title="Delete" data-toggle="modal"
                                                data-target="#delete-jur{{ $item->id }}"><i
                                                    class=" material-icons">&#xE872;</i></a>
                                        </td> --}}
                                        @include('guru.jurnal.delete')
                                        @include('guru.jurnal.foto')
                                        @include('guru.jurnal.ttd')

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
            <form action="{{ route('guru.jurnal.viewpdf') }}" method="get" id="view-pdf-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="filter">Filter</label>
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
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <button type="submit" name="action" value="view" class="btn btn-primary" id="view-pdf-btn">Lihat PDF</button>
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

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    $.fn.editable.defaults.mode = "inline";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $('.editable[data-name="name"]').editable({
        url: "{{ route('guru.jurnal.update') }}",
        type: 'select',
        pk: 1,
        name: 'name',
        title: 'pilih pertemuan',
        source: [
            @for ($i = 1; $i <= 20; $i++)
                { value: "Pertemuan {{ $i }}", text: "Pertemuan {{ $i }}" },

            @endfor
        ],
        success: function (response, newValue) {
            if (response.error) {
                $.notify({
                    icon: 'nc-icon nc-bell-55',
                    message: response.error
                }, {
                    type: 'danger',
                    timer: 3000
                });
                return false;
            } else {
                $.notify({
                    icon: 'nc-icon nc-check-2',
                    message: 'Data berhasil diupdate.'
                }, {
                    type: 'success',
                    timer: 3000
                });
            }
        }
    });
    $('.editable[data-name="materi"]').editable({
        url: "{{ route('guru.jurnal.update') }}",
        type: 'text',
        pk: 1,
        name: 'materi',
        title: 'input materi',
        success: function (response, newValue) {
            if (response.error) {
                $.notify({
                    icon: 'nc-icon nc-bell-55',
                    message: response.error
                }, {
                    type: 'danger',
                    timer: 3000
                });
                return false;
            } else {
                $.notify({
                    icon: 'nc-icon nc-check-2',
                    message: 'Data berhasil diupdate.'
                }, {
                    type: 'success',
                    timer: 3000
                });
            }
        }
    });
    $('.editable[data-name="sakit"]').editable({
        url: "{{ route('guru.jurnal.update') }}",
        type: 'number',
        min: '0',
        pk: 1,
        name: 'sakit',
        title: 'input sakit',
        success: function (response, newValue) {
            if (response.error) {
                $.notify({
                    icon: 'nc-icon nc-bell-55',
                    message: response.error
                }, {
                    type: 'danger',
                    timer: 3000
                });
                return false;
            } else {
                $.notify({
                    icon: 'nc-icon nc-check-2',
                    message: 'Data berhasil diupdate.'
                }, {
                    type: 'success',
                    timer: 3000
                });
            }
        }
    });
    $('.editable[data-name="izin"]').editable({
        url: "{{ route('guru.jurnal.update') }}",
        type: 'number',
        min: '0',
        pk: 1,
        name: 'izin',
        title: 'input izin',
        success: function (response, newValue) {
            if (response.error) {
                $.notify({
                    icon: 'nc-icon nc-bell-55',
                    message: response.error
                }, {
                    type: 'danger',
                    timer: 3000
                });
                return false;
            } else {
                $.notify({
                    icon: 'nc-icon nc-check-2',
                    message: 'Data berhasil diupdate.'
                }, {
                    type: 'success',
                    timer: 3000
                });
            }
        }
    });
    $('.editable[data-name="alpha"]').editable({
        url: "{{ route('guru.jurnal.update') }}",
        type: 'number',
        min: '0',
        pk: 1,
        name: 'alpha',
        title: 'input alpha',
        success: function (response, newValue) {
            if (response.error) {
                $.notify({
                    icon: 'nc-icon nc-bell-55',
                    message: response.error
                }, {
                    type: 'danger',
                    timer: 3000
                });
                return false;
            } else {
                $.notify({
                    icon: 'nc-icon nc-check-2',
                    message: 'Data berhasil diupdate.'
                }, {
                    type: 'success',
                    timer: 3000
                });
            }
        }
    });
    $('.editable[data-name="catatan"]').editable({
        url: "{{ route('guru.jurnal.update') }}",
        type: 'textarea',
        rows: '2',
        pk: 1,
        name: 'catatan',
        title: 'input catatan',
        success: function (response, newValue) {
            if (response.error) {
                $.notify({
                    icon: 'nc-icon nc-bell-55',
                    message: response.error
                }, {
                    type: 'danger',
                    timer: 3000
                });
                return false;
            } else {
                $.notify({
                    icon: 'nc-icon nc-check-2',
                    message: 'Data berhasil diupdate.'
                }, {
                    type: 'success',
                    timer: 3000
                });
            }
        }
    });

</script>


@endsection