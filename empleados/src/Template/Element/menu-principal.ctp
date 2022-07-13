<?php 
$usuario = $this->request->getSession()->read('Auth.User');
$perfiles = array(1,2,3); //1-administrador, 2-empleado, 3-cliente 
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <li class="nav-item">
    <!-- Sidebar - Brand -->
    	<div class="sidebar-brand-icon rotate-n-15 center">
        	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <!-- <i class="fas fa-clipboard-list"></i>-->
            	<img style="display:inline;margin:auto;" height="60" src="<?php echo $this->Url->image('logo.png');?>">
           	</a>
        </div>
        <!-- <div class="sidebar-brand-text mx-3">Admin</div>-->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Principal
    </div>
    </li>    
    <!-- Item Menu -->
	<li class="nav-item">
		<?php if($usuario['tipo_usuario']==1){?>
        <a class="nav-link" href="/users/">
            <i class="fas fa-fw fa-user"></i>
            <span>Empleados</span>
        </a>
        <?php } elseif ($usuario['tipo_usuario']==2) { ?>
        <a class="nav-link" href="/users/view/<?php echo $usuario['id'];?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Perfil</span>
        </a>
        <?php }?>
    </li>
    <!--<?php //if(in_array($usuario['tipo_usuario'],$perfiles)) {?>
    <li class="nav-item">
    	<?php //if($usuario['tipo_usuario']==3){?>
    	<a class="nav-link" href="/users/view/<?php echo $usuario['id'];?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Ver cliente</span>
        </a>
        <?php //} else {?>-->
    <?php if($usuario['tipo_usuario']==1){?>
    <li class="nav-item">
        <a class="nav-link" href="/clientes/index">
            <i class="fas fa-fw fa-user"></i>
            <span>Clientes</span>
        </a>
        <?php //} ?>
    </li>
     <?php } ?>
    <li class="nav-item">
        <a class="nav-link" href="/tareas/index">
            <i class="fas fa-fw fa-folder"></i>
            <span>Tareas</span>
        </a>
    </li>
    <?php //if($usuario['tipo_usuario']==2){?> 
    <li class="nav-item">
        <a class="nav-link" href="/viaticos/index">
            <i class="fas fa-fw fa-folder"></i>
            <span>Viaticos</span>
        </a>
    </li>
    <?php //} ?>
    <?php if($usuario['tipo_usuario']==1){?> 
    <li class="nav-item">
        <div >
        	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
            	<i class="fas fa-fw fa-table"></i>
            	<span class="">Parametricas</span>
            </a>
            <ul id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            	<li><a class="nav-link" style="padding:5px;" href="/EstadosServicio/"><span>Estados de Servicio</span></a></li>
            	<li><a class="nav-link" style="padding:5px;" href="/servicios/"><span>Servicios</span></a></li>         	
            	<li><a class="nav-link" style="padding:5px;" href="/TiposTarea/"><span>Tipos de Tarea</span></a></li>
            	<li><a class="nav-link" style="padding:5px;" href="/TiposUsuario/"><span>Tipos de Usuario</span></a></li>
            	<li><a class="nav-link" style="padding:5px;" href="/TiposPago/"><span>Tipos de Pago</span></a></li>
            	<li><a class="nav-link" style="padding:5px;" href="/TiposFactura/"><span>Tipos de Factura</span></a></li>
            </ul>
        </div>
    </li>
    
    <?php } ?>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>