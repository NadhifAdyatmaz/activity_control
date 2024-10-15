@extends('kepsek/master')

@section('title', 'Profile')

@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-user">
        <div class="card-header" style="margin-bottom: 20px;">
          <h5 class="title">{{ __('Edit Profil') }}</h5>
        </div>
        <!-- <div class="image">
          <img src="../assets/img/logo-smk-full.png" alt="...">
        </div> -->
        <div class="card-body">
          <form action="{{ route('kepsek.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="author text-center position-relative">
              <img id="avatar-img" class="avatar border-gray"
                src="{{ Auth::user()->photo ? asset(Auth::user()->photo) : asset('assets/img/default-avatar.png') }}"
                alt="...">

              <label for="avatar-input" class="btn btn-link position-absolute top-0 start-0 p-0">
                <i class="fa fa-edit" style="font-size: 1rem;"></i>
              </label>
              <input type="file" id="avatar-input" name="photo" style="display: none;">
              <small class="text-muted">maks. 5 MB</small>
              <!-- <h5 class="title">{{ Auth::user()->name }}</h5> -->
              <!-- <p class="description">{{ Auth::user()->username }}</p> -->
              <!-- </div>
                <div class="row mt-3">
                    <div class="update mx-auto">
                        <button type="submit" class="btn btn-primary btn-round">
                            Update Photo
                        </button>
                    </div>
                </div> -->

              <!-- Profile Update Fields -->
              <div class="row justify-content-center mt-3">
                <div class="col-md-6">
                  @foreach ($infos as $item)
            <div class="form-group">
            <label>Sekolah (disabled)</label>
            <input type="text" class="form-control" disabled placeholder="Sekolah"
              value="{{$item->sekolah ?? "Nama Sekolah"}}">
            </div>
          @endforeach
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">{{ __('Email address') }}</label>
                    <x-text-input id="email" name="email" type="email" class=" block w-full form-control"
                      :value="old('email', Auth::user()->email)" required autocomplete="email" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    @if (
              Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&
              !Auth::user()->hasVerifiedEmail()
            )
                      <div>
                        <p class="text-sm mt-2 text-gray-800">
                        {{ __('Email anda belum terverifikasi') }}
                        <button form="send-verification"
                          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          {{ __('Klik disini untuk mengirim ulang verifikasi email') }}
                        </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
              <p class="mt-2 font-medium text-sm text-green-600">
              {{ __('A new verification link has been sent to your email address.') }}
              </p>
            @endif
                      </div>
          @endif
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="username">{{ __('Username') }}</label>
                    <x-text-input id="username" name="username" type="text" class="mt-1 block w-full form-control"
                      :value="old('username', Auth::user()->username)" placeholder="Username" required />
                    <x-input-error class="mt-2" :messages="$errors->get('username')" />
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full form-control"
                      :value="old('name', Auth::user()->name)" placeholder="Nama" required autofocus
                      autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="jabatan">{{ __('Jabatan') }}</label>
                    <x-text-input id="jabatan" name="jabatan" type="text" class="mt-1 block w-full form-control"
                      :value="old('jabatan', Auth::user()->jabatan)" placeholder="Jabatan" />
                    <x-input-error class="mt-2" :messages="$errors->get('jabatan')" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="phone">{{ __('Telepon') }}</label>
                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full form-control"
                      :value="old('phone', Auth::user()->phone)" placeholder="Telepon" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <div class="row">
                  <div class="update ml-auto mr-auto">
                    <x-primary-button class="btn btn-primary btn-round">{{ __('Update Profile') }}</x-primary-button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card card-user">
        <div class="card-header" style="margin-bottom: 20px;">
          <h5 class="title">{{ __('Ubah Password') }}</h5>
        </div>
        <div class="card-body">
          <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div class="form-group">
              <x-input-label for="update_password_current_password" :value="__('Current Password')" />
              <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="form-control mt-1 block w-full" autocomplete="current-password" />
              <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div class="form-group">
              <x-input-label for="update_password_password" :value="__('New Password')" />
              <x-text-input id="update_password_password" name="password" type="password"
                class="form-control mt-1 block w-full" autocomplete="new-password" />
              <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div class="form-group">
              <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
              <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="form-control mt-1 block w-full" autocomplete="new-password" />
              <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="card-footer">
              <div class="d-flex justify-content-end">
                <x-primary-button class="btn btn-primary btn-round">{{ __('Save') }}</x-primary-button>

                <!-- @if (session('status') === 'password-updated')
          <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600">{{ __('Saved.') }}</p>
        @endif -->
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    @if (session('status') === 'profile-updated')
    $.notify({
      icon: 'nc-icon nc-check-2',
      message: 'Data berhasil diupdate.'
    }, {
      type: 'success',
      timer: 3000
    });
  @elseif (session('status') === 'profile-update-failed')
  $.notify({
    icon: 'nc-icon nc-check-2',
    message: 'Data gagal diupdate.'
  }, {
    type: 'success',
    timer: 3000
  });
@endif
    // Notifikasi untuk update password
    @if (session('status') === 'password-updated')
    $.notify({
      icon: 'nc-icon nc-check-2',
      message: 'Password berhasil diubah.'
    }, {
      type: 'success',
      timer: 3000
    });
  @elseif (session('status') === 'password-update-failed')
  $.notify({
    icon: 'nc-icon nc-simple-remove',
    message: 'Password gagal diubah. Periksa input Anda.'
  }, {
    type: 'danger',
    timer: 3000
  });
@endif
  });
</script>
@endsection