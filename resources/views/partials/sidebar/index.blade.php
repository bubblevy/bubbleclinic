@can('admin')
<li class="menu-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/dashboard'">
    <i class="menu-icon tf-icons bx bx-desktop"></i>
    <div>Dashboard</div>
  </a>
</li>
<li class="menu-item {{ Request::is('admin/antrian*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/antrian'">
    <i class="menu-icon tf-icons bx bx-street-view"></i>
    <div>Daftar Antrian</div>
  </a>
</li>
<li class="menu-item {{ Request::is('admin/daftar-antrian-terlambat*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/daftar-antrian-terlambat'">
    <i class="menu-icon tf-icons bx bx-recycle"></i>
    <div>Antrian Terlambat</div>
  </a>
</li>
<li class="menu-item {{ Request::is('admin/pasien*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/pasien'">
    <i class="menu-icon tf-icons bx bx-group"></i>
    <div>Data Pasien</div>
  </a>
</li>
<li class="menu-item {{ Request::is('admin/pengaturan*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/pengaturan'">
    <i class="menu-icon tf-icons bx bx-cog"></i>
    <div>Pengaturan</div>
  </a>
</li>
@endcan