<?php
use Cake\Core\Configure;
$url = Configure::read('App.fullBaseUrl').DS.DIRHOST;
$user = $this->request->getSession()->read('Auth.User');
?>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>
<h3 style="color:#961F25;">ADMINISTRACIÓN UECARA DEL INTERIOR</h3>
<!-- Topbar Search -->
<!--form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
  <div class="input-group">
    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
    <div class="input-group-append">
      <button class="btn btn-primary" type="button">
        <i class="fas fa-search fa-sm"></i>
      </button>
    </div>
  </div>
</form-->
<ul class="navbar-nav ml-auto">
  <div class="topbar-divider d-none d-sm-block"></div>
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= (isset($user))? strval($user['nombre']): "desconhecido" ?></span>
      <img class="img-profile rounded-circle" src="<?php echo $this->Url->image('user.png');?>">
    </a>
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
	<?= $this->Html->link('<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> '.__('Mis Datos'), ['controller'=>'users','action' => 'view',@$user["id"]], ['escape' => false,"class" => "dropdown-item"]) ?>
	<?= $this->Html->link('<i class="fas fa-id-card-alt fa-sm fa-fw mr-2 text-gray-400"></i> '.__('Perfil'), ['controller'=>'perfil','action' => 'view',@$user["perfil_id"]], ['escape' => false,"class" => "dropdown-item"]) ?>
	<?php if(intval(@$user["perfil_id"]) !== 3): ?>
	<?= $this->Html->link('<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> '.__('Configuración'),'#', ['escape' => false,"class" => "dropdown-item"]) ?>
	<?php endif; ?>
	<?= $this->Html->link('<i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i> '.__('Cambiar contraseña'), ['controller'=>'users','action' => 'change_pass'], ['escape' => false,"class" => "dropdown-item"]) ?>
    <div class="dropdown-divider"></div>
	<?= $this->Html->link('<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> '.__('Cerrar Sesión'), '#', ['escape' => false,"class" => "dropdown-item", "data-toggle"=>"modal","data-target"=>"#logoutModal"]) ?>
    </div>
  </li>
</ul>
</nav>