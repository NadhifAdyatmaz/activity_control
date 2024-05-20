@extends('admin/master')

@section('title', 'Profile')

@section('admin')
<div class="content">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-user">
        <div class="image">
          <!-- <img src="../assets/img/logo-smk-full.png" alt="..."> -->
        </div>
        <div class="card-body">
          <form>
            <div class="author">
              <a>
                <img class="avatar border-gray" src="../assets/img/default-avatar.png" alt="...">
                <h5 class="title">{{ Auth::user()->name }}</h5>
              </a>
              <p class="description">
                {{ Auth::user()->username }}
              </p>
            </div>
            <!-- <p class="description text-center">
                          "I like the way you work it <br>
                          No diggity <br>
                          I wanna bag it up"
                        </p> -->
            <div class="row">
              <div class="update ml-auto mr-auto">
                <button type="submit" class="btn btn-primary btn-round">Update Photo</button>
              </div>
            </div>
          </form>
        </div>
        <!-- <div class="card-footer">
                  <hr>
                  <div class="button-container">
                    <div class="row">
                      <div class="col-lg-3 col-md-6 col-6 ml-auto">
                        <h5>12<br><small>Files</small></h5>
                      </div>
                      <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                        <h5>2GB<br><small>Used</small></h5>
                      </div>
                      <div class="col-lg-3 mr-auto">
                        <h5>24,6$<br><small>Spent</small></h5>
                      </div>
                    </div>
                  </div>
                </div> -->
      </div>
    </div>
    <div class="col-md-8">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">Edit Profile</h5>
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>School (disabled)</label>
                  <input type="text" class="form-control" disabled="" placeholder="Company" value="SMKN 1 Tanjung Bumi">
                </div>
              </div>
              <!-- <div class="col-md-3 px-1">
                              <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" placeholder="Username" value="admin">
                              </div>
                            </div> -->
              <div class="col-md-6 pl-1">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" placeholder="Email" value="{{ Auth::user()->email }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" placeholder="Username" value="{{ Auth::user()->username }}">
                </div>
              </div>
              <div class="col-md-8 pl-1">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Name" value="{{ Auth::user()->name }}">
                </div>
              </div>
            </div>
            <!-- <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Address</label>
                              <input type="text" class="form-control" placeholder="Home Address" value="{{ Auth::user()->name }}">
                            </div>
                          </div>
                        </div> -->
            <div class="row">
              <div class="col-md-8 pr-1">
                <div class="form-group">
                  <label>Jabatan</label>
                  <input type="text" class="form-control" placeholder="Jabatan" value="{{ Auth::user()->jabatan }}">
                </div>
              </div>
              <div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>Telepon</label>
                  <input type="text" class="form-control" placeholder="Telepon" value="{{ Auth::user()->phone }}">
                </div>
              </div>
              <!-- <div class="col-md-4 pl-1">
                            <div class="form-group">
                              <label>Postal Code</label>
                              <input type="number" class="form-control" placeholder="ZIP Code">
                            </div>
                          </div> -->
            </div>
            <!-- <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>About Me</label>
                              <textarea class="form-control textarea">Oh so, your weak rhyme You doubt I'll bother, reading into it</textarea>
                            </div>
                          </div>
                        </div> -->
            <div class="row">
              <div class="update ml-auto mr-auto">
                <button type="submit" class="btn btn-primary btn-round">Update Profile</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <form class="col-md-12" action="{{ route('password.update') }}" method="POST">
      @csrf
      @method('PUT')
      <div class="card">
        <div class="card-header">
          <h5 class="title">{{ __('Change Password') }}</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <label class="col-md-3 col-form-label">{{ __('Old Password') }}</label>
            <div class="col-md-9">
              <div class="form-group">
                <input type="password" name="old_password" class="form-control" placeholder="Old password" required>
              </div>
              @if ($errors->has('old_password'))
        <span class="invalid-feedback" style="display: block;" role="alert">
          <strong>{{ $errors->first('old_password') }}</strong>
        </span>
      @endif
            </div>
          </div>
          <div class="row">
            <label class="col-md-3 col-form-label">{{ __('New Password') }}</label>
            <div class="col-md-9">
              <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
              </div>
              @if ($errors->has('password'))
        <span class="invalid-feedback" style="display: block;" role="alert">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
      @endif
            </div>
          </div>
          <div class="row">
            <label class="col-md-3 col-form-label">{{ __('Password Confirmation') }}</label>
            <div class="col-md-9">
              <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control"
                  placeholder="Password Confirmation" required>
              </div>
              @if ($errors->has('password_confirmation'))
        <span class="invalid-feedback" style="display: block;" role="alert">
          <strong>{{ $errors->first('password_confirmation') }}</strong>
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
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection