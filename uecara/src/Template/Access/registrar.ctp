
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 card-registrar">
      <div class="card-body p-0">
      	<img src="<?php echo $this->Url->image('logo_uecara.png');?>" style="width:100%; border:none;" />
        <!-- Nested Row within Card Body -->
        <div class="row">
          <!--div class="col-lg-5 d-none d-lg-block bg-register-image"></div-->
          <div class="col-lg-3 d-none d-lg-block"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Nuevo Usuario</h1>
              </div>
              <?= $this->Flash->render() ?>
              <?= $this->Form->create($user, array('role' => 'form',"class" => "user")) ?>
                <div class="box-body">
                <?php
                    echo $this->Form->control('nombre',["error" => false,"class" => "form-control"]);
                    echo $this->Form->control('apellido',["error" => false,"class" => "form-control"]);
                    echo $this->Form->control('email',["error" => false,"class" => "form-control"]);
                    echo $this->Form->control('password',["label"=>"Contraseña","error" => false,"class" => "form-control"]);
                ?>
                </div>
                <!-- /.box-body -->
                <div class="box-footer pt-4">
                    <?= $this->Form->button(__('Aceptar'),["class" => "btn btn-danger btn-user btn-block"]) ?>
                </div>
                <!-- <hr>
                <a href="/" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Registrar con Google
                </a>
                <a href="/" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Registrar con Facebook
                </a>-->
            <?= $this->Form->end() ?>
              <hr>
              <div class="text-center">
                <a class="small" href="./recuperar">Recordarme Contraseña</a>
              </div>
              <div class="text-center">
                <a class="small" href="./login">Volver al login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  


