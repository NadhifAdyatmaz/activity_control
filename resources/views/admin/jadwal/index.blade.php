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

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

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
                                        <option>Semua</option>
                                        <option>2023</option>
                                        <option>2024</option>
                                        <option>2025</option>
                                        <option>2026</option>
                                        <option>2027</option>
                                        <option>2028</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label>Guru : </label>
                                    <select class="form-control">
                                        <option>Semua</option>
                                        <option>Ghafur</option>
                                        <option>Anas</option>
                                        <option>Jakfar</option>
                                        <option>DIo</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label>Hari : </label>
                                    <select class="form-control">
                                        <option>Semua</option>
                                        <option>Senin</option>
                                        <option>Selasa</option>
                                        <option>Rabu</option>
                                        <option>Kamis</option>
                                        <option>Jumat</option>
                                        <option>Sabtu</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-sm-0">
                                <a class="filter-icon" href="#add-jadwal" data-toggle="modal"><i
                                        class="fa fa-plus-square"></i> Tambah</a>
                            </div>
                            <div class="col-sm-0">
                                <a class="filter-icon addjadwal" href="#"><i class="fa fa-plus-square"></i> Tambah</a>
                            </div>

                            <div class="col-sm-1">
                                <a class="filter-icon" href="#"><i class="fa fa-file-excel-o"></i> Impor</a>

                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form id="addJadwal" method="post">
                            <span id="result"></span>
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tahun Ajaran</th>
                                        <th>Hari</th>
                                        <th>Jam Ke</th>
                                        <th>Guru</th>
                                        <th>Mapel</th>
                                        <th>Kelas</th>
                                        <th style="text-align: center">
                                            <a href="#" class="addRow">
                                                <span class="material-icons">add_box</span>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwals as $key => $item)
                                        <tr>
                                            <td>
                                                <a class="editable" data-name="jampel_id" data-type="select"
                                                    data-pk="{{ $item->id }}" data-title="Pilih Jam Ke" data-source='[
                                                                                                    @foreach ($periodes as $periode)
                                                                                                        {"value": "{{ $periode->id }}", "text": "{{ $periode->name }} - {{ $periode->semester }}"}{{ !$loop->last ? ',' : '' }}

                                                                                                    @endforeach
                                                                                                    ]'>
                                                    {{ $item->periodes->name }} - {{ $item->periodes->semester }}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="editable" data-name="hari" data-type="select"
                                                    data-pk="{{ $item->id }}" data-title="Pilih Hari"
                                                    data-source='[
                                                                                                        {"value": "1", "text": "senin"},
                                                                                                        {"value": "2", "text": "selasa"},
                                                                                                        {"value": "3", "text": "rabu"},
                                                                                                        {"value": "4", "text": "kamis"},
                                                                                                        {"value": "5", "text": "jumat"},
                                                                                                        {"value": "6", "text": "sabtu"}]'>
                                                    {{ $item->hari }}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="editable" data-name="jampel_id" data-type="select"
                                                    data-pk="{{ $item->id }}" data-title="Pilih Jam Ke" data-source='[
                                                                                                    @foreach ($jampels as $jampel)
                                                                                                        {"value": "{{ $jampel->id }}", "text": "{{ $jampel->jam_ke }}"}{{ !$loop->last ? ',' : '' }}

                                                                                                    @endforeach
                                                                                                    ]'>
                                                    {{ $item->jampels->jam_ke }}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="editable" data-name="user_id" data-type="select"
                                                    data-pk="{{ $item->id }}" data-title="Pilih Guru" data-source='[
                                                                                                    @foreach ($users as $user)
                                                                                                        {"value": "{{ $user->id }}", "text": "{{ $user->name }}"}{{ !$loop->last ? ',' : '' }}

                                                                                                    @endforeach
                                                                                                    ]'>
                                                    {{ $item->users->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="editable" data-name="mapel_id" data-type="select"
                                                    data-pk="{{ $item->id }}" data-title="Pilih Mapel" data-source='[
                                                                                                    @foreach ($mapels as $mapel)
                                                                                                        {"value": "{{ $mapel->id }}", "text": "{{ $mapel->name }}"}{{ !$loop->last ? ',' : '' }}

                                                                                                    @endforeach
                                                                                                    ]'>
                                                    {{ $item->mapels->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="editable" data-name="kelas_id" data-type="select"
                                                    data-pk="{{ $item->id }}" data-title="Pilih Kelas" data-source='[
                                                                                                    @foreach ($kelas as $kelass)
                                                                                                        {"value": "{{ $kelass->id }}", "text": "{{ $kelass->name }}"}{{ !$loop->last ? ',' : '' }}

                                                                                                    @endforeach
                                                                                                    ]'>
                                                    {{ $item->kelas->name }}
                                                </a>
                                            </td>
                                            <td style="text-align: center">
                                                <a href="#" class="delete" title="Delete" data-toggle="modal"
                                                    data-target="#delete-jadwal{{ $item->id }}"><i
                                                        class="material-icons">&#xE872;</i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" style="text-align: center;">&nbsp;</td>
                                        <td>
                                            @csrf

                                            <input type="submit" name="save" id="save" class="btn btn-primary"
                                                value="Simpan" />
                                        </td>

                                    </tr>
                                </tfoot>
                            </table>
                        </form>
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
                        <!-- <div class="d-flex align-items-center">
                            <span class="mr-2">Status:</span>
                            <div class="filter-group">
                                <select class="form-control">
                                    <option>Aktif</option>
                                    <option>Tidak Atif</option>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary">Save</button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.jadwal.delete')


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $(document).ready(function () {

        var count = 1;

        addRow(count);

        function addRow(number) {
            var html = '<tr>';

            html += '<td>' +
                '<div class="form-group">' +
                '<select name="periode_id[]" id="periode_id" class="form-control">' +
                '<option value="">Pilih Tahun Ajaran</option>' +
                '@foreach ($periodes as $periode)' +
                    '<option value="{{ $periode->id }}">{{ $periode->name }} {{ $periode->semester }}</option>' +
                '@endforeach' +
                '</select>' +
                '</div>' +
                '@error("periode_id")' +
                    '<div class="alert-danger mx-4 my-2 px-2 py-2">{{ $message }}</div>' +
                '@enderror' +
                '</td>';

            html += '<td>' +
                '<div class="form-group">' +
                '<select name="hari[]" id="hari" class="form-control">' +
                '<option value="">Pilih Hari</option>' +
                '<option value="senin">Senin</option>' +
                '<option value="selasa">Selasa</option>' +
                '<option value="rabu">Rabu</option>' +
                '<option value="kamis">Kamis</option>' +
                '<option value="jumat">Jumat</option>' +
                '<option value="sabtu">Sabtu</option>' +
                '</select>' +
                '</div>' +
                '@error("hari")' +
                    '<div class="alert-danger mx-4 my-2 px-2 py-2">{{ $message }}</div>' +
                '@enderror' +
                '</td>';

            html += '<td>' +
                '<div class="form-group">' +
                '<select name="jampel_id[]" id="jampel_id" class="form-control">' +
                '<option value="">Pilih Jam</option>' +
                '@foreach ($jampels as $jampel)' +
                    '<option value="{{ $jampel->id }}">{{ $jampel->jam_ke }} - {{ $jampel->pukul }}</option>' +
                '@endforeach' +
                '</select>' +
                '</div>' +
                '@error("jampel_id")' +
                    '<div class="alert-danger mx-4 my-2 px-2 py-2">{{ $message }}</div>' +
                '@enderror' +
                '</td>';

            html += '<td>' +
                '<div class="form-group">' +
                '<select name="user_id[]" id="user_id" class="form-control">' +
                '<option value="">Pilih Guru</option>' +
                '@foreach ($users as $guru)' +
                    '<option value="{{ $guru->id }}">{{ $guru->name }}</option>' +
                '@endforeach' +
                '</select>' +
                '</div>' +
                '@error("user_id")' +
                    '<div class="alert-danger mx-4 my-2 px-2 py-2">{{ $message }}</div>' +
                '@enderror' +
                '</td>';

            html += '<td>' +
                '<div class="form-group">' +
                '<select name="mapel_id[]" id="mapel_id" class="form-control">' +
                '<option value="">Pilih Mapel</option>' +
                '@foreach ($mapels as $mapel)' +
                    '<option value="{{ $mapel->id }}">{{ $mapel->name }}</option>' +
                '@endforeach' +
                '</select>' +
                '</div>' +
                '@error("mapel_id")' +
                    '<div class="alert-danger mx-4 my-2 px-2 py-2">{{ $message }}</div>' +
                '@enderror' +
                '</td>';

            html += '<td>' +
                '<div class="form-group">' +
                '<select name="kelas_id[]" id="kelas_id" class="form-control">' +
                '<option value="">Pilih Kelas</option>' +
                '@foreach ($kelas as $kelass)' +
                    '<option value="{{ $kelass->id }}">{{ $kelass->name }}</option>' +
                '@endforeach' +
                '</select>' +
                '</div>' +
                '@error("kelas_id")' +
                    '<div class="alert-danger mx-4 my-2 px-2 py-2">{{ $message }}</div>' +
                '@enderror' +
                '</td>';

            html += '<td style="text-align: center">' +
                '<a href="#" class="remove" title="Remove" data-toggle="tooltip"><span class="material-icons">delete</span></a>' +
                '</td>';

            html += '</tr>';

            $('tbody').append(html);
        }


        $(document).on('click', '.addRow', function () {
            count++;
            addRow(count);
        });

        $(document).on('click', '.remove', function () {
            count--;
            $(this).closest("tr").remove();
        });

        $('#addJadwal').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('admin.jadwal.insert') }}',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('#save').attr('disabled', 'disabled');
                },
                success: function (data) {
                    // console.log(data);
                    if (data.error) {
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++) {
                            error_html += '<p>' + data.error[count] + '</p>';
                        }
                        $('#result').html('<div class="alert alert-danger alert-with-icon alert-dismissible fade show"' +
                            'data-notify="container">' +
                            '<button type="button" aria-hidden="true" class="close" data-dismiss="alert"' +
                            'aria-label="Close">' +
                            '<i class="nc-icon nc-simple-remove"></i>' +
                            '</button>' +
                            '<span data-notify="icon" class="nc-icon nc-bell-55"></span>' +
                            '<span data-notify="message">' + error_html + '</span>' +
                            '</div>');
                    }
                    else {
                        addRow(1);
                        $('#result').html('<div class="alert alert-info alert-with-icon alert-dismissible fade show"' +
                            'data-notify="container">' +
                            '<button type="button" aria-hidden="true" class="close" data-dismiss="alert"' +
                            'aria-label="Close">' +
                            '<i class="nc-icon nc-simple-remove"></i>' +
                            '</button>' +
                            '<span data-notify="icon" class="nc-icon nc-alert-circle-i"></span>' +
                            '<span data-notify="message">' + data.success + '</span>' +
                            '</div>');
                    }
                    $('#save').attr('disabled', false);
                }
            })
        });

    });
</script>

<script>
    $.fn.editable.defaults.mode = 'inline';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $('.editable[data-name="hari"]').editable({
        url: '{{ route('admin.jadwal.update') }}',
        type: 'select',
        pk: 1,
        name: 'hari',
        title: 'Pilih Hari',
        source: [
            { value: "1", text: "senin" },
            { value: "2", text: "selasa" },
            { value: "3", text: "rabu" },
            { value: "4", text: "kamis" },
            { value: "5", text: "jumat" },
            { value: "6", text: "sabtu" }]
    });

    $('.editable[data-name="jampel_id"]').editable({
        url: '{{ route('admin.jadwal.update') }}',
        type: 'select',
        pk: 1,
        name: 'jampel_id',
        title: 'Pilih Jam Ke',
        source: [
            @foreach ($jampels as $key => $item)
                { value: "{{ $key + 1 }}", te          xt: "{{ $item->jam_ke }}"},

            @endforeach
        ]
    });

    $('.editable[data-name="user_id"]').editable({
        url: '{{ route('admin.jadwal.update') }}',
        type: 'select',
        pk: 1,
        name: 'user_id',
        title: 'Pilih Guru',
        source: [
            @foreach ($users as $key => $item)
                { value: "{{ $key + 1 }}", te          xt: "{{ $item->name }}"},

            @endforeach
        ]
    });

    $('.editable[data-name="mapel_id"]').editable({
        url: '{{ route('admin.jadwal.update') }}',
        type: 'select',
        pk: 1,
        name: 'mapel_id',
        title: 'Pilih Mapel',
        source: [
            @foreach ($mapels as $key => $item)
                { value: "{{ $key + 1 }}", te          xt: "{{ $item->name }}"},

            @endforeach
        ]
    });

    $('.editable[data-name="kelas_id"]').editable({
        url: '{{ route('admin.jadwal.update') }}',
        type: 'select',
        pk: 1,
        name: 'kelas_id',
        title: 'Pilih Kelas',
        source: [
            @foreach ($kelas as $key => $item)
                { value: "{{ $key + 1 }}", te          xt: "{{ $item->name }}"},

            @endforeach
        ]
    });
</script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script> -->
@endsection