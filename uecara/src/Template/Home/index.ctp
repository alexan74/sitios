<?php
use Cake\Core\Configure;
$url = Configure::read('App.fullBaseUrl');
$user = $this->request->getSession()->read('UserFront');
?>
<?php if (empty($user)) { ?>
<div class="container home">
	<div class="card o-hidden border-0 shadow-lg my-5">
		<div class="card-body p-0">
            <div class="row">
          		<div class="col-lg-12 my-1"><?= $this->Flash->render() ?></div>
                <!--div class="col-lg-6 d-none d-lg-block bg-login-image"></div-->
              	<div class="col-lg-3 d-none d-lg-block"></div>
              	<div class="col-lg-6">
            		<div class="p-5">
                  		<div class="text-center">
                  			<h1 class="h4 text-gray-900 mb-4">ACCESO DE EMPRESAS</h1>
                  		</div>
                        <?= $this->Form->create("index",["class" => "user"]) ?>
                        <?= $this->Form->control('cuit',['type' => "text", 'class' => "form-control form-control-user", 'placeholder' => "Ingrese cuit...", 'name' => "cuit", "aria-describedby"=>"cuitHelp"]) ?>
                        <br>
                        <?= $this->Form->control('password',['label'=>'Contraseña','type' => "password", 'class' => "form-control form-control-user", 'placeholder' => "Ingrese contraseña..."]) ?>
                        <br>
                        <?= $this->Form->button('Entrar',["type" => "submit", "class" => "btn btn-danger btn-user btn-block"]) ?>
                        <?= $this->Form->end() ?>
                        <hr>
                        <div class="text-center">
                        <!-- <a class="small" href="<?php //echo $url;?>/home/alta-empresa">Registrarme</a>-->
                        <a class="small" href="#"<?php //echo $url;?>>Recuperar Contraseña</a>
                        </div>
                	</div>
              	</div>
          	</div>
       	</div>
   	</div>
</div>
<?php } else { ?>
<div class="container home">
	<div class="card o-hidden border-0 shadow-lg my-5">
		<div class="card-body p-0">
			 
            <div class="row">
              	<div class="col-lg-12">
                    <div class="p-5" style="display:table;width:100%;">
                    	<span style="font-size:18px; font-weight:bold; color: #9C2026;">Empresa: <?php echo $user['denom_social'];?></span>
          				<div class="fright">
          				<?= $this->Html->link('<i class="fas fa-fw fa-home"></i> <span>Cerrar Sesión</span>', ['controller'=>'home','action' => 'logout'], ['escape' => false,"class" => "btn btn-danger"]); ?>
          				</div>
          				<div style="clear:both;"><br /></div>
						<div class="text-center">
                            <div class="bg-password-image" style="margin:0 auto;min-height:500px;"></div>
                            <div style="clear:both;"><br /></div>
                            <div style="margin:0 auto;">
                                 <div class="fleft text-left" style="width:30%;">
                                 <?= $this->Html->link('Mis tramites', ['controller'=>'home','action' =>'tramites',$user['id']],['escape' => false,"class" => "btn btn-danger"]); ?>
                                 </div>
                                 <div class="fleft" style="width:33%;">
                                  <?= $this->Html->link('Subir archivos', ['controller'=>'home','action' =>'archivos',$user['id']],['escape' => false,"class" => "btn btn-danger"]); ?>
                                 </div>
                                 <div class="fright text-right" style="width:33%;">
                                  <a href="#" class="btn btn-danger">Boleta de depósito</a>
                                 </div>
                          </div> 
						</div>
					</div>
    			</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>


