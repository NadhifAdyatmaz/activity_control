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
                                    <input type="text" class="form-control"
                                        value="{{ $selectperiode->name ?? "-"}} {{ $selectperiode->semester ?? "tidak ada"}}"
                                        readonly>

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
                                <div class="filter-group">
                                    <label>Hari : </label>
                                    <select class="form-control">
                                        <option>Semua</option>
                                        <option value="senin">Senin</option>
                                        <option value="selasa">Selasa</option>
                                        <option value="rabu">Rabu</option>
                                        <option value="kamis">Kamis</option>
                                        <option value="jumat">Jumat</option>
                                        <option value="sabtu">Sabtu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form id="addJadwal" method="post">
                            <span id="result"></span>
                            <table id="myDataTable" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tahun Ajaran</th>
                                        <th>Hari</th>
                                        <th>Jam Ke</th>
                                        <th>Guru</th>
                                        <th>Mapel</th>
                                        <th>Kelas</th>
                                        <th style="text-align: center">
                                            <!-- <a href="#" class="addRow">
                                                <span class="material-icons">add_box</span>
                                            </a> -->
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwals as $key => $item)
                                        <tr>
                                            <td>
                                                <a class="editable" data-name="jampel_id" data-type="select"
                                                    data-pk="{{ $item->id }}" data-title="Pilih Jam Ke"
                                                    data-source='[
                                                                                                                                    @foreach ($periodes as $periode)
                                                                                                                                        {"value": "{{ $periode->id }}", "text": "{{ $periode->name }} {{ $periode->semester }}"}{{ !$loop->last ? ',' : '' }}

                                                                                                                                    @endforeach
                                                                                                                                    ]'>
                                                    {{ $item->periodes->name }} {{ $item->periodes->semester }}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="editable" data-name="hari" data-type="select"
                                                    data-pk="{{ $item->id }}" data-title="Pilih Hari"
                                                    data-source='[
                                                                                                                                        {"value": "senin", "text": "senin"},
                                                                                                                                        {"value": "selasa", "text": "selasa"},
                                                                                                                                        {"value": "rabu", "text": "rabu"},
                                                                                                                                        {"value": "kamis", "text": "kamis"},
                                                                                                                                        {"value": "jumat", "text": "jumat"},
                                                                                                                                        {"value": "sabtu", "text": "sabtu"}]'>
                                                    {{ $item->hari ?? "pilih hari"}}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="editable" data-name="jampel_id" data-type="select"
                                                    data-pk="{{ $item->id }}" data-title="Pilih Jam Ke"
                                                    data-source='[
                                                                                                                                    @foreach ($jampels as $jampel)
                                                                                                                                        {"value": "{{ $jampel->id }}", "text": "{{ $jampel->jam_ke }}"}{{ !$loop->last ? ',' : '' }}

                                                                                                                                    @endforeach
                                                                                                                                    ]'>
                                                    {{ $item->jampels->jam_ke ?? "pilih jam ke"}}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="editable" data-name="user_id" data-type="select"
                                                    data-pk="{{ $item->id }}" data-title="Pilih Guru"
                                                    data-source='[
                                                                                                                                    @foreach ($users as $user)
                                                                                                                                        {"value": "{{ $user->id }}", "text": "{{ $user->name }}"}{{ !$loop->last ? ',' : '' }}

                                                                                                                                    @endforeach
                                                                                                                                    ]'>
                                                    {{ $item->users->name ?? "pilih guru"}}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="editable" data-name="mapel_id" data-type="select"
                                                    data-pk="{{ $item->id }}" data-title="Pilih Mapel"
                                                    data-source='[
                                                                                                                                    @foreach ($mapels as $mapel)
                                                                                                                                        {"value": "{{ $mapel->id }}", "text": "{{ $mapel->name }}"}{{ !$loop->last ? ',' : '' }}

                                                                                                                                    @endforeach
                                                                                                                                    ]'>
                                                    {{ $item->mapels->name ?? "pilih mapel"}}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="editable" data-name="kelas_id" data-type="select"
                                                    data-pk="{{ $item->id }}" data-title="Pilih Kelas"
                                                    data-source='[
                                                                                                                                    @foreach ($kelas as $kelass)
                                                                                                                                        {"value": "{{ $kelass->id }}", "text": "{{ $kelass->name }}"}{{ !$loop->last ? ',' : '' }}

                                                                                                                                    @endforeach
                                                                                                                                    ]'>
                                                    {{ $item->kelas->name ?? "pilih kelas"}}
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
                                            <input type="hidden" name="periode_id" id="periode_id"
                                                value="{{ $selectperiode->id ?? null}}" />

                                            <input type="submit" name="save" id="save" class="btn btn-primary"
                                                value="Tambah" />
                                        </td>

                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                        @include('admin.jadwal.delete')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    $(document).ready(function () {
        $('#addJadwal').on('submit', function (event) {
            event.preventDefault();

            $(this).find('input[name="periode_id"]').val('{{ $selectperiode->id ?? null}}');

            $.ajax({
                url: '{{ route('admin.jadwal.insert') }}',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('#save').attr('disabled', true);
                },
                success: function (data) {
                    let alertType = data.error ? 'danger' : 'info';
                    let alertIcon = data.error ? 'nc-bell-55' : 'nc-alert-circle-i';
                    let message = data.error ? data.error.join('<br>') : data.success;

                    $('#result').html(
                        `<div class="alert alert-${alertType} alert-with-icon alert-dismissible fade show" data-notify="container">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span data-notify="icon" class="nc-icon ${alertIcon}"></span>
                            <span data-notify="message">${message}</span>
                        </div>`
                    );

                    $('#save').attr('disabled', false);

                    if (!data.error) {
                        location.reload();
                    }
                }
            });
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
            { value: "senin", text: "senin" },
            { value: "selasa", text: "selasa" },
            { value: "rabu", text: "rabu" },
            { value: "kamis", text: "kamis" },
            { value: "jumat", text: "jumat" },
            { value: "sabtu", text: "sabtu" }],
        success: function (response, newValue) {
            if (response.error) {
                $.notify({
                    icon: 'nc-icon nc-bell-55',
                    message: response.error
                }, {
                    type: 'danger',
                    timer: 3000
                });
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

    $('.editable[data-name="jampel_id"]').editable({
        url: '{{ route('admin.jadwal.update') }}',
        type: 'select',
        pk: 1,
        name: 'jampel_id',
        title: 'Pilih Jam Ke',
        source: [
            @foreach ($jampels as $key => $item)
                { value: "{{ $key + 1 }}", text: "{{ $item->jam_ke }}" },

            @endforeach
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

    $('.editable[data-name="user_id"]').editable({
        url: '{{ route('admin.jadwal.update') }}',
        type: 'select',
        pk: 1,
        name: 'user_id',
        title: 'Pilih Guru',
        source: [
            @foreach ($users as $key => $item)
                { value: "{{ $key + 1 }}", text: "{{ $item->name }}" },

            @endforeach
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

    $('.editable[data-name="mapel_id"]').editable({
        url: '{{ route('admin.jadwal.update') }}',
        type: 'select',
        pk: 1,
        name: 'mapel_id',
        title: 'Pilih Mapel',
        source: [
            @foreach ($mapels as $key => $item)
                { value: "{{ $key + 1 }}", text: "{{ $item->name }}" },

            @endforeach
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

    $('.editable[data-name="kelas_id"]').editable({
        url: '{{ route('admin.jadwal.update') }}',
        type: 'select',
        pk: 1,
        name: 'kelas_id',
        title: 'Pilih Kelas',
        source: [
            @foreach ($kelas as $key => $item)
                { value: "{{ $key + 1 }}", text: "{{ $item->name }}" },

            @endforeach
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