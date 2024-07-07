<div class="logo">
  <a href="#" class="simple-text logo-mini">
    
    <div class="logo-image-small">
      <img src="{{ $info->logo ? asset($info->logo) : asset('assets/img/noimg.png') }}">
    </div>
    <!-- <p>CT</p> -->
  </a>
  <a class="simple-text-lg text-white logo-normal">
    {{$info->sekolah ?? "Nama Sekolah"}}
    <!-- <div class="logo-image-big">
      <img src="../assets/img/logo-big.png">
    </div> -->
  </a>
</div>
<!-- MENU -->
<div class="sidebar-wrapper">
  <ul class="nav">
    <li class="{{ Route::currentRouteName() == 'guru.dashboard' ? 'active' : '' }}">
      <a href="{{ route('guru.dashboard') }}">
        <i class="nc-icon nc-bank"></i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="{{ Route::currentRouteName() == 'guru.jadwal' ? 'active' : '' }}">
      <a href="{{ route('guru.jadwal') }}" class="{{ request()->routeIs('guru.jadwal') ? 'active-item' : '' }}">
        <i class="nc-icon nc-calendar-60"></i>
        <p>JADWAL MENGAJAR</p>
      </a>
    </li>
    <li class="{{ Route::currentRouteName() == 'guru.jurnal' ? 'active' : '' }}">
      <a href="{{ route('guru.jurnal') }}">
        <i class="fa fa-book"></i>
        <p>JURNAL MENGAJAR</p>
      </a>
    </li>

  </ul>
</div>