<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'ADN SISTEMAS - Admin. Fumigaciones Kashi Control';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('../vendor/fontawesome-free/css/all.min.css'); ?>
    <?= $this->Html->css('../vendor/jquery/jquery-ui.min'); ?>
    <?= $this->Html->css('sb-admin-2.min') ?>
    <?= $this->Html->css('datatables/dataTables.bootstrap4.min') ?> 
    <?= $this->Html->css('bootstrap-multiselect'); ?>
    <!--<?php //echo $this->Html->css('base.css') ?>-->
    <?= $this->Html->css('style.css') ?>
    
    <?= $this->Html->script('../vendor/jquery/jquery.min.js') ?>
    
    <?= $this->Html->script('../vendor/bootstrap/js/bootstrap.bundle.min.js') ?>
    <?= $this->Html->script('../vendor/jquery/jquery-ui.min'); ?> 
    <?= $this->Html->script('../vendor/jquery-easing/jquery.easing.min.js') ?>
    <?= $this->Html->script('bootstrap-multiselect'); ?>
    <?= $this->Html->script('bootbox.min'); ?>
    
       
    <!-- <script src="https://kit.fontawesome.com/adca86933e.js" crossorigin="anonymous"></script>-->
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?php $user = $this->request->getSession()->read('Auth.User');?>
</head>
<?php if ($user) { ?>
<body id="page-top">
	<div id="wrapper">
    	<?= $this->element('menu-principal');?>
    	<div id="content-wrapper" class="d-flex flex-column">
    	<?= $this->element('barra-superior');?>
            <div id="content">
    			<?= $this->Flash->render() ?>
                <div class="container-fluid">
    				<?= $this->fetch('content') ?>
    			</div>
    		</div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Desarrollado por ADN Sistemas - Copyright &copy; 2021</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Scroll Top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lista para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="/users/logout">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
<body class="bg-gradient-primary">
	<div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
<?php } ?>
<?= $this->Html->script('sb-admin-2.min.js') ?>
<script src="/js/datatables/jquery.dataTables.min.js"></script>
<script src="/js/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  	//$('#dataTable').DataTable();
  	$('#dataTable').dataTable({
				 "language": {
				           "paginate": {
				             "first": "Primero",
				             "last": "Último",
				             "next": "Siguiente",
				             "previous": "Anterior"
				           },
				           "emptyTable": "No hay registro que mostrar",
				           "info": "Página _PAGE_ de _PAGES_ - Total _MAX_ registros",
				           "infoEmpty": "",
				           "infoFiltered": " - Filtrando _MAX_ registros",
				           "lengthMenu": 'Mostrar <select>'+
			 					'<option value="10">10</option>'+
			 					'<option value="20">20</option>'+
			 					'<option value="30">30</option>'+
			 					'<option value="40">40</option>'+
			 					'<option value="50">50</option>'+
			 					'<option value="-1">Todos</option>'+
			 					'</select> registros',
			 				"loadingRecords": "Espere por favor - cargando...",
			 				"processing": "Procesando...",
			 				"search": "Buscar:"
				 }
	});
});
</script>
</body>
</html>
