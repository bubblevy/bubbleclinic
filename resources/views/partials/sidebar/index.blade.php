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
    <div>Registrar Datos</div>
  </a>
</li>
<li class="menu-item {{ Request::is('admin/PRUEBA*') ? 'active' : '' }}">
  <a class="menu-link cursor-pointer" onclick="window.location.href='/admin/PRUEBA'">
    <i class="menu-icon tf-icons bx bx-street-view"></i>
    <div>PRUEBA DE MODULOS</div>
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