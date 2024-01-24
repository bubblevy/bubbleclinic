@can('admin')
<li class="menu-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/dashboard'">
    <i class="menu-icon tf-icons bx bx-desktop"></i>
    <div>Inicio</div>
  </a>
</li>
<li class="menu-item {{ Request::is('admin/antrian*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/antrian'">
    <i class="menu-icon tf-icons bx bx-street-view"></i>
    <div>Daftra Antrian</div>
  </a>
</li>

<li class="menu-item {{ Request::is('admin/files*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/files'">
    <i class="menu-icon tf-icons bx bx-street-view"></i>
    <div>Registro de Datos</div>
  </a>
</li>

<li class="menu-item {{ Request::is('admin/modulo0*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/modulo0'">
    <i class="menu-icon tf-icons bx bx-street-view"></i>
    <div>MODULO 0</div>
  </a>
</li>
<li class="menu-item {{ Request::is('admin/modulo1*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/modulo1'">
    <i class="menu-icon tf-icons bx bx-street-view"></i>
    <div>MODULO 1</div>
  </a>
</li>
<li class="menu-item {{ Request::is('admin/modulo3*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/modulo3'">
    <i class="menu-icon tf-icons bx bx-street-view"></i>
    <div>MODULO 3</div>
  </a>
</li>
<li class="menu-item {{ Request::is('admin/daftar-antrian-terlambat*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/daftar-antrian-terlambat'">
    <i class="menu-icon tf-icons bx bx-recycle"></i>
    <div>Resumen de Datos</div>
  </a>
</li>
<li class="menu-item {{ Request::is('admin/pasien*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/pasien'">
    <i class="menu-icon tf-icons bx bx-group"></i>
    <div>Consulta de datos</div>
  </a>
</li>
<li class="menu-item {{ Request::is('admin/pengaturan*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/pengaturan'">
    <i class="menu-icon tf-icons bx bx-cog"></i>
    <div>Configuracion de Perfil</div>
  </a>
</li>
@endcan