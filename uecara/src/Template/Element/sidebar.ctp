<?php
use Cake\Core\Configure;
$url = Configure::read('App.fullBaseUrl').DS.DIRHOST;
$user = $this->request->getSession()->read('Auth.User');
?>
<ul class="navbar-nav bg-gradient-uecara sidebar sidebar-dark accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-clipboard"></i>
    </div>
    <div class="sidebar-brand-text mx-3">MENU</div>
  </a>
  <hr class="sidebar-divider my-0">
  <?php if(intval(@$user["perfil_id"]) === 1): ?>
  <li class="nav-item active">
  	<?= $this->Html->link('<i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span>', ['controller'=>'admin','action' => 'index'], ['escape' => false,"class" => "nav-link"]); ?>
  </li>
  <hr class="sidebar-divider">
  <?php endif; ?>
  <?php if(intval(@$user["perfil_id"]) !== 3): ?>
  <div class="sidebar-heading">
    Administradores
  </div>
  <li class="nav-item">
    <?= $this->Html->link('<i class="fas fa-fw fa-users"></i> <span>Usuarios</span>', 
        ['#'],['escape' => false,"class" => "nav-link", "data-toggle"=>"collapse", "data-target"=>"#collapseUsuarios", "aria-expanded"=>"true", "aria-controls"=>"collapseUsuarios"]
    ); ?>
    <div id="collapseUsuarios" class="collapse" aria-labelledby="headingUsuarios" data-parent="#accordionSidebar">
      <div class="bg-red py-2 collapse-inner rounded">
        <h6 class="collapse-header"></h6>
        <?= $this->Html->link('Consulta', ['controller'=>'users','action' => 'index'], ['escape' => false,"class"=>"collapse-item"]); ?>
        <?= $this->Html->link('Nuevo Usuario', ['controller'=>'users','action' => 'add'], ['escape' => false,"class"=>"collapse-item"]); ?>
      </div>
    </div>
  </li>
  <li class="nav-item">
 	<?= $this->Html->link('<i class="fas fa-fw fa-users-cog"></i> <span>Perfiles</span>', 
        ['#'],['escape' => false,"class" => "nav-link", "data-toggle"=>"collapse", "data-target"=>"#collapsePerfiles", "aria-expanded"=>"true", "aria-controls"=>"collapsePerfiles"]
    ); ?>
    <div id="collapsePerfiles" class="collapse" aria-labelledby="headingPerfiles" data-parent="#accordionSidebar">
      <div class="bg-red py-2 collapse-inner rounded">
        <h6 class="collapse-header"></h6>
        <?= $this->Html->link('Consulta', ['controller'=>'perfil','action' => 'index'], ['escape' => false,"class"=>"collapse-item"]); ?>
        <?= $this->Html->link('Nuevo Perfil', ['controller'=>'perfil','action' => 'add'], ['escape' => false,"class"=>"collapse-item"]); ?>
      </div>
    </div>
  </li>
  <?php endif; ?>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Empresas
  </div>
  <?php if(intval(@$user["perfil_id"]) !== 3): ?>
  <li class="nav-item">
  	<?= $this->Html->link('<i class="fas fa-fw fa-file-signature"></i> <span>Lista Empresas</span>', 
  	    ['controller'=>'empresas','action' => 'index'],['escape' => false,"class" => "nav-link"]
    ); ?>
  </li>
  <li class="nav-item">
  	<?= $this->Html->link('<i class="fas fa-fw fa-file-signature"></i> <span>Categorias</span>', 
  	    ['controller'=>'categorias-empresa','action' => 'index'],['escape' => false,"class" => "nav-link"]
    ); ?>
  </li>
  <li class="nav-item">
  	<?= $this->Html->link('<i class="fas fa-fw fa-file-signature"></i> <span>Tipos</span>', 
  	    ['controller'=>'tipos-empresa','action' => 'index'],['escape' => false,"class" => "nav-link"]
    ); ?>
  </li>
  <?php endif; ?>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Mantenimiento
  </div>
  <li class="nav-item">
  	<?= $this->Html->link('<i class="fas fa-fw fa-id-card-alt"></i> <span>Afiliados</span>', 
        ['#'],['escape' => false,"class" => "nav-link", "data-toggle"=>"collapse", "data-target"=>"#collapseAfiliados", "aria-expanded"=>"true", "aria-controls"=>"collapseAfiliados"]
    ); ?>
    <div id="collapseAfiliados" class="collapse" aria-labelledby="headingAfiliados" data-parent="#accordionSidebar">
      <div class="bg-red py-2 collapse-inner rounded">
        <!-- <h6 class="collapse-header">Custom Utilities:</h6>-->
        <?= $this->Html->link('Consulta', ['controller'=>'afiliados','action' => 'index'], ['escape' => false,"class"=>"collapse-item"]); ?>
        <?= $this->Html->link('Nuevo Afiliado', ['controller'=>'afiliados','action' => 'add'], ['escape' => false,"class"=>"collapse-item"]); ?>
        <?= $this->Html->link('Acción Social', ['#'], ['escape' => false,"class"=>"collapse-item"]); ?>
      </div>
    </div>
  </li>
  <?php if(intval(@$user["perfil_id"]) === 1): ?>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Sistema
  </div>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Components</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Custom Components:</h6>
        <a class="collapse-item" href="<?= $url;?>/pages/buttons">Buttons</a>
        <a class="collapse-item" href="<?= $url;?>/pages/cards">Cards</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Utilities</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Custom Utilities:</h6>
        <a class="collapse-item" href="./pages/utilitiescolor">Colors</a>
        <a class="collapse-item" href="./pages/utilitiesborder">Borders</a>
        <a class="collapse-item" href="./pages/utilitiesanimation">Animations</a>
        <a class="collapse-item" href="./pages/utilitiesother">Other</a>
      </div>
    </div>
  </li>
  <div class="sidebar-heading">
    Addons
  </div>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Login Screens:</h6>
        <a class="collapse-item" href="./pages/login">Login</a>
        <a class="collapse-item" href="./pages/register">Register</a>
        <a class="collapse-item" href="./pages/forgotpassword">Forgot Password</a>
        <div class="collapse-divider"></div>
        <h6 class="collapse-header">Other Pages:</h6>
        <a class="collapse-item" href="./pages/404">404 Page</a>
        <a class="collapse-item" href="./pages/blank">Blank Page</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./pages/charts">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Charts</span></a>
  </li>

  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="./pages/tables">
      <i class="fas fa-fw fa-table"></i>
      <span>Tables</span></a>
  </li>
  <?php endif; ?>
  <hr class="sidebar-divider d-none d-md-block">
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>