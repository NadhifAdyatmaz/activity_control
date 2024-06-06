@extends('admin/master')

@section('title', 'Profile')

@section('admin')
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
          <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
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
              <small class="text-muted">maks. 2 MB</small>
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
              <div class="row mt-3">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Sekolah (disabled)</label>
                    <input type="text" class="form-control" disabled placeholder="Sekolah" value="SMKN 1 Tanjung Bumi">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">{{ __('Email address') }}</label>
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full form-control"
                      :value="old('email', Auth::user()->email)" required autocomplete="username" />
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
                    <label for="username">{{ __('Username') }} (disabled)</label>
                    <x-text-input id="username" name="username" type="text" class="mt-1 block w-full form-control"
                      disabled :value="old('username', Auth::user()->username)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('username')" />
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full form-control"
                      :value="old('name', Auth::user()->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="jabatan">{{ __('Jabatan') }}</label>
                    <x-text-input id="jabatan" name="jabatan" type="text" class="mt-1 block w-full form-control"
                      :value="old('jabatan', Auth::user()->jabatan)" />
                    <x-input-error class="mt-2" :messages="$errors->get('jabatan')" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="phone">{{ __('Telepon') }}</label>
                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full form-control"
                      :value="old('phone', Auth::user()->phone)" />
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
          </form>
        </div>
      </div>
    </div>

    <!-- <form class="col-md-12 mt-6 space-y-6" action="{{ route('password.update') }}" method="POST">
      @csrf
      @method('PUT')
      <div class="card">
        <div class="card-header">
          <h5 class="title">{{ __('Change Password') }}</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <label class="col-md-3 col-form-label"
              for="update_password_current_password">{{ __('Old Password') }}</label>
            <div class="col-md-9">
              <div class="form-group">
                <x-text-input id="update_password_current_password" name="current_password" type="password"
                  class="mt-1 block w-full form-control" autocomplete="current-password" placeholder="Old password"
                  required />
              </div>
              @if ($errors->updatePassword->has('current_password'))
        <span class="invalid-feedback" style="display: block;" role="alert">
          <strong>{{ $errors->updatePassword->first('current_password') }}</strong>
        </span>
      @endif
            </div>
          </div>
          <div class="row">
            <label class="col-md-3 col-form-label" for="update_password_password">{{ __('New Password') }}</label>
            <div class="col-md-9">
              <div class="form-group">
                <x-text-input id="update_password_password" name="password" type="password"
                  class="mt-1 block w-full form-control" autocomplete="new-password" placeholder="Password" required />
              </div>
              @if ($errors->updatePassword->has('password'))
        <span class="invalid-feedback" style="display: block;" role="alert">
          <strong>{{ $errors->updatePassword->first('password') }}</strong>
        </span>
      @endif
            </div>
          </div>
          <div class="row">
            <label class="col-md-3 col-form-label"
              for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
            <div class="col-md-9">
              <div class="form-group">
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                  class="mt-1 block w-full form-control" autocomplete="new-password" placeholder="Password Confirmation"
                  required />
              </div>
              @if ($errors->updatePassword->has('password_confirmation'))
        <span class="invalid-feedback" style="display: block;" role="alert">
          <strong>{{ $errors->updatePassword->first('password_confirmation') }}</strong>
        </span>
      @endif
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <div class="row">
            <div class="col-md-12 text-center">
              <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
            </div>
            @if (session('status') === 'password-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
      @endif
          </div>
        </div>
      </div>
    </form> -->

  </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Success</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ __('Profil berhasil diupdate') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Failure Modal -->
<div class="modal fade" id="failureModal" tabindex="-1" aria-labelledby="failureModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="failureModalLabel">Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ __('Profil gagal diupdate. Silahkan coba lagi.') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    @if (session('status') === 'profile-updated')
    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
    successModal.show();
  @elseif (session('status') === 'profile-update-failed')
  var failureModal = new bootstrap.Modal(document.getElementById('failureModal'));
  failureModal.show();
@endif
  });
</script>
@endsection