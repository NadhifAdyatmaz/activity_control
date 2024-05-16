  <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logo-smk.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a class="simple-text-lg text-white logo-normal">
        SMKN 1 Tanjung Bumi
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <!-- MENU -->
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }} ">
            <a href="{{route('admin.dashboard')}}">
              <i class="nc-icon nc-layout-11"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- <li class="{{ Route::currentRouteName() == 'admin.profile' ? 'active' : '' }} ">
            <a href="{{route('admin.profile')}}">
              <i class="nc-icon nc-single-02"></i>
              <p>Profile</p>
            </a>
          </li> -->
          <li class="{{ Route::currentRouteName() == 'admin.jadwal' ? 'active' : '' }} ">
            <a href="{{route('admin.jadwal')}}">
              <i class="nc-icon nc-paper"></i>
              <p>Jadwal</p>
            </a>
          </li>
          <li class="{{ Route::currentRouteName() == 'admin.jurnal' ? 'active' : '' }} ">
            <a href="{{route('admin.jurnal')}}">
              <i class="nc-icon nc-single-copy-04"></i>
              <p>Jurnal</p>
            </a>
          </li>
          <li class="{{ Route::currentRouteName() == 'admin.info' ? 'active' : '' }} ">
            <a href="#">
              <i class="nc-icon nc-alert-circle-i"></i>
              <p>Info</p>
            </a>
          </li>
          <div class="logo">
          </div>
          <!-- <br> -->
          <!-- <a class="text-light" class="simple-text logo-mini">
              <div class="typography-line">
                <h6>Master Data</h6>
              </div>
          </a>

          <li class="{{ Route::currentRouteName() == 'admin.info' ? 'active' : '' }} ">
            <a href="#">
              <i class="nc-icon nc-simple-add"></i>
              <p>Guru</p>
            </a>
          </li>
          <li class="{{ Route::currentRouteName() == 'admin.info' ? 'active' : '' }} ">
            <a href="#">
              <i class="nc-icon nc-simple-add"></i>
              <p>Kelas</p>
            </a>
          </li>
          <li class="{{ Route::currentRouteName() == 'admin.info' ? 'active' : '' }} ">
            <a href="#">
              <i class="nc-icon nc-simple-add"></i>
              <p>Pelajaran</p>
            </a>
          </li> -->

          <li class="{{ Route::currentRouteName() == 'admin.info' || Route::currentRouteName() == 'admin.info' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" href="#laravelExamples">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>
                            {{ __('Master Data') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ Route::currentRouteName() == 'admin.info' ? 'active' : '' }}">
                            <a href="#">
                            <i class="nc-icon nc-simple-add"></i>
                                <p>{{ __(' Periode ') }}</p>
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'admin.info' ? 'active' : '' }}">
                            <a href="#">
                            <i class="nc-icon nc-simple-add"></i>
                                <p>{{ __(' Mata Pelajaran ') }}</p>
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'admin.info' ? 'active' : '' }}">
                            <a href="#">
                            <i class="nc-icon nc-simple-add"></i>
                                <p>{{ __(' Jam Pelajaran ') }}</p>
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'admin.info' ? 'active' : '' }}">
                            <a href="#">
                            <i class="nc-icon nc-simple-add"></i>
                                <p>{{ __(' Kelas ') }}</p>
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'admin.info' ? 'active' : '' }}">
                            <a href="#">
                            <i class="nc-icon nc-simple-add"></i>
                                <p>{{ __(' Guru ') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

          <!-- <li class="active-pro">
            
            <a href="#">
              <i class="nc-icon nc-share-66"></i>
              <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <p :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </p>
                        </form>
            </a>
          </li> -->
        </ul>
        </div>