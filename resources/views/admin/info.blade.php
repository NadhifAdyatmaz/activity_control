@extends('admin/master')

@section('title', 'Informasi')

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
  <div class="row">
    <div class="col-md-12">
      <div class="card card-user">
        <div class="card-header" style="margin-bottom: 20px;">
          <h2 class="title">{{ __('Informasi') }}</h2>
        </div>
        @if ($infos != null && $infos->isNotEmpty())
          <div class="card-body">
            @foreach ($infos as $info)
            <form action="{{ route('admin.info.edit', $info->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('post')
              <div class="author text-center position-relative">
              <img class="border-gray" width="150" height="150" src="{{ $info->logo ? asset($info->logo) : asset('assets/img/noimg.png') }}" alt="...">
              <label for="avatar-input-{{ $info->id }}" class="btn btn-link position-absolute top-0 start-0 p-0">
                  <i class="fa fa-edit" style="font-size: 1rem;"></i>
              </label>
              <input type="file" id="avatar-input-{{ $info->id }}" name="logo" style="display: none;">
              <div class="row justify-content-center mt-3">
                  <small class="text-muted">maks. 5 MB</small>
              </div>
                <div class="row justify-content-center mt-3">
                  <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">{{ __('Update Foto') }}</button>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                  <div class="col-md-4">
                  <div class="form-group">
                    <label>Kepala Sekolah</label>
                      <a class="editable form-control" data-name="name" data-type="text" data-pk="{{ $info->id }}"
                        data-title="Enter Name" style="text-align: center">{{ $info->name ?? "Waka Kurikulum"}}</a>
                  </div>
                  </div>
                </div>
                <div class="row justify-content-center mt-3">
                  <div class="col-md-4">
                  <div class="form-group">
                    <label>Sekolah</label>
                    <a class="editable form-control" data-name="sekolah" data-type="text" data-pk="{{ $info->id }}"
                      data-title="Enter sekolah" style="text-align: center">{{ $info->sekolah ?? "Sekolah"}}</a>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <label>Email Sekolah</label>
                    <a class="editable form-control" data-name="email" data-type="text" data-pk="{{ $info->id }}"
                      data-title="Enter sekolah" style="text-align: center">{{ $info->email ?? "Email Sekolah"}}</a>
                  </div>
                  </div>
                </div>
                <div class="row justify-content-center">
                  <div class="col-md-2">
                  <div class="form-group">
                    <label>Telp</label>
                    <a class="editable form-control" data-name="phone" data-type="text" pattern="[0-9]+"
                    data-pk="{{ $info->id }}" data-title="Enter phone"
                    style="text-align: center">{{ $info->phone ?? "Telp. Sekolah"}}</a>
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                  </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                    <label>Jumlah Pertemuan</label>
                    <a class="editable form-control" data-name="pertemuan" data-type="number" min="0"
                    data-pk="{{ $info->id }}" data-title="Enter pertemuan"
                    style="text-align: center">{{ $info->pertemuan ?? "Pertemuan"}}</a>
                    <x-input-error class="mt-2" :messages="$errors->get('pertemuan')" />
                  </div>
                  </div>
                </div>
              </div>
            </form>
            @endforeach
          </div>
        @else
          <div class="card-body">
            <form action="{{ route('admin.info.add') }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('post')
              <div class="author text-center position-relative">
                <img class="border-gray" width="150" height="150" src="{{ asset('assets/img/default-avatar.png') }}"
                  alt="...">
                <label for="avatar-input" class="btn btn-link position-absolute top-0 start-0 p-0">
                  <i class="fa fa-edit" style="font-size: 1rem;"></i>
                </label>
                <input type="file" id="avatar-input" name="logo" style="display: none;">
                <small class="text-muted">maks. 5 MB</small>
                <div class="row justify-content-center mt-3">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Kepala Sekolah</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" 
                            name="name" value="{{ old('name') }}">
                            <small class="form-text text-muted text-sm">*contoh: Abdul Ghafur, S.Pd</small>
                    </div>
                    @error('name')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row justify-content-center mt-3">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="sekolah">Sekolah</label>
                        <input type="text" id="sekolah" class="form-control @error('sekolah') is-invalid @enderror" 
                            name="sekolah" value="{{ old('sekolah') }}">
                            <small class="form-text text-muted text-sm">*contoh: SMKN 1 Malang</small>
                    </div>
                    @error('sekolah')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                        <label for="email">Email Sekolah</label>
                        <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}">
                            <small class="form-text text-muted text-sm">*contoh: smkn1malang@school.ac.id</small>
                    </div>
                    @error('email')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row justify-content-center">
                  <div class="col-md-2">
                  <div class="form-group">
                        <label for="phone">Telp. Sekolah</label>
                        <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" 
                            name="phone" value="{{ old('phone') }}">
                            <small class="form-text text-muted text-sm">*contoh: 031234455</small>
                    </div>
                    @error('phone')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-2">
                  <div class="form-group">
                        <label for="pertemuan">Jumlah Pertemuan</label>
                        <input type="number" min="1" id="pertemuan" class="form-control @error('pertemuan') is-invalid @enderror" 
                            name="pertemuan" value="{{ old('pertemuan') }}">
                            <small class="form-text text-muted text-sm">*contoh: 15</small>
                    </div>
                    @error('pertemuan')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">{{ __('Tambah Data') }}</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

<script>
  $.fn.editable.defaults.mode = "inline";

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
  });

  $('.editable[data-name="name"]').editable({
    url: "{{ route('admin.info.update') }}",
    type: 'text',
    pk: 1,
    name: 'name',
    title: 'Enter name'
  });
  $('.editable[data-name="sekolah"]').editable({
    url: "{{ route('admin.info.update') }}",
    type: 'text',
    pk: 1,
    name: 'sekolah',
    title: 'Enter name'
  });
  $('.editable[data-name="email"]').editable({
    url: "{{ route('admin.info.update') }}",
    type: 'text',
    pk: 1,
    name: 'email',
    title: 'Enter name'
  });
  $('.editable[data-name="phone"]').editable({
    url: "{{ route('admin.info.update') }}",
    type: 'text',
    pattern: '[0-9]+',
    pk: 1,
    name: 'phone',
    title: 'Enter name'
  });
  $('.editable[data-name="pertemuan"]').editable({
    url: "{{ route('admin.info.update') }}",
    type: 'number',
    min: '1',
    pk: 1,
    name: 'pertemuan',
    title: 'Enter name'
  });
</script>

@endsection