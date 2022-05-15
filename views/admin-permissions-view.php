<?php require_once 'access-security.php'; ?>
<div class="callout callout-info">
  <h5><i class="fas fa-users-cog"></i> Asignar o quitar permisos de administrador</h5>
</div>

<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-md-4">
    <div class="card card-primary">
      <div class="card-header ui-sortable-handle">
        <h3 class="card-title text-uppercase">FILTRAR POR</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-4">
        <div class="row">
          <div class="col-md-12 mb-1">
            <div class="form-group">
              <label for="typeuser">Tipo de usuario</label>
              <select class="custom-select" id="typeuser">
                <option value="">Todos</option>
                <option value="A">Solo Administradores</option>
                <option value="U">Solo Usuarios</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="input-search">Buscar</label>
              <div class="input-group">
                <input type="text" class="form-control" id="input-search" maxlength="20" autocomplete="off">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" id="btn-search">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card card-primary">
      <div class="card-header ui-sortable-handle">
        <h3 class="card-title text-uppercase">LISTA DE USUARIOS</h3>
      </div>
      <div class="card-body table-responsive p-4">
        <table id="tbl-usuarios" class="table table-valign-middle">
          <thead>
            <tr>
              <th width='10%'>Foto</th>
              <th>Nombre</th>
              <th>Fecha registrado</th>
              <th width='10%'>Admin</th>
            </tr>
          </thead>
          <tbody id="tbl-permissions-user">
            <!-- cargados de forma asincrono -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="dist/js/pages/admin-permissions.js"></script>