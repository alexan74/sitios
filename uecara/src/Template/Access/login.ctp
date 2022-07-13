

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
	
      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5 card-login">
          <div class="card-body p-0">
          	<img src="<?php echo $this->Url->image('logo_uecara.png');?>" style="width:100%; border:none;" />
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12 my-1"><?= $this->Flash->render() ?></div>
              <!--div class="col-lg-6 d-none d-lg-block bg-login-image"></div-->
              <div class="col-lg-3 d-none d-lg-block"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Administración</h1>
                  </div>
                  
                  <?= $this->Form->create("login",["class" => "user"]) ?>
                  <?= $this->Form->control('email',['type' => "text", 'class' => "form-control form-control-user", 'placeholder' => "Ingrese email...", 'name' => "email", "aria-describedby"=>"emailHelp"]) ?>
                  <br>
                  <?= $this->Form->control('password',['label'=>'Contraseña','type' => "password", 'class' => "form-control form-control-user", 'placeholder' => "Ingrese contraseña..."]) ?>
                  <br>
                  <?= $this->Form->button('Entrar',["type" => "submit", "class" => "btn btn-danger btn-user btn-block"]) ?>
                  <?= $this->Form->end() ?>

                  <!--form class="user">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <a href="/" class="btn btn-primary btn-user btn-block">
                      Login
                    </a>
                    <hr>
                    <a href="/" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="/" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>
                  </form-->
                  <hr>
                  <div class="text-center">
                    <a class="small" href="./recuperar">Recuperar Contraseña</a>
                    <!-- <a class="small" href=",/recuperar"><?php //echo __('Forgot Password?');?></a>-->
                  </div>
                  <div class="text-center">
                    <a class="small" href="./registrar">Registrarme</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

