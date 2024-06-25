@extends('guru/template')

@section('title', 'Profile')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-user">
                {{-- <div class="image">
                    <img src="../assets/img/damir-bosnjak.jpg" alt="...">
                </div>
                <div class="card-body">
                    <div class="author">
                        <a href="#">
                            <img class="avatar border-gray" src="../assets/img/mike.jpg" alt="...">
                            <h5 class="title">Administrator</h5>
                        </a>
                        <p class="description">
                            @admin
                        </p>
                    </div>
                    <p class="description text-center">
                        "I like the way you work it <br>
                        No diggity <br>
                        I wanna bag it up"
                    </p> --}}
                </div>
            </div>
        </div>
        <div class="col-md-">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('guru.profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf <!-- Token CSRF Laravel -->
                        @method('patch') <!-- Menggunakan metode PUT untuk mengirimkan data -->
                        <div class="author text-center position-relative">
                          <img id="avatar-img" class="avatar border-gray"
                            src="{{ Auth::user()->photo ? asset(Auth::user()->photo) : asset('1') }}"
                            alt="...">

                          <label for="avatar-input" class="btn btn-link position-absolute top-0 start-0 p-0">
                            <i class="fa fa-edit" style="font-size: 1rem;"></i>
                          </label>
                          <input type="file" id="avatar-input" name="photo" style="display: none;">
                          <!-- <h5 class="title">{{ Auth::user()->name }}</h5> -->
                          <!-- <p class="description">{{ Auth::user()->username }}</p> -->

                        <div class="row">
                            <!-- Kolom untuk Email -->
                            <div class="col-md-6 pr-10">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                            <!-- Kolom untuk Username -->
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ Auth::user()->username }}">
                                </div>
                            </div>
                        </div>
                        <!-- Lanjutkan dengan menambahkan input untuk atribut lainnya seperti nama, jabatan, nomor HP, dll. -->
                        <div class="row">
                            <!-- Kolom untuk Nama -->
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <!-- Kolom untuk Jabatan -->
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control" placeholder="Jabatan" value="{{ Auth::user()->jabatan }}">
                                </div>
                            </div>
                        </div>
                        <!-- Lanjutkan dengan menambahkan kolom untuk nomor HP dan peran jika diperlukan -->
                        <div class="row">
                            <!-- Kolom untuk Nomor HP -->
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No hp</label>
                                    <input type="text" name="phone" class="form-control" placeholder="No hp" value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                            <!-- Kolom untuk Peran -->
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role</label>
                                    <input type="text" name="role" class="form-control" placeholder="Role" value="{{ Auth::user()->role }}">
                                </div>
                            </div>
                        </div>
                        <!-- Tombol untuk mengirimkan formulir -->
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary btn-round">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
        {{ __('Your profile has been updated successfully.') }}
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
        {{ __('There was an error updating your profile. Please try again.') }}
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
