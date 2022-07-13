
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Confirmar Contraseña Nueva</h1>
                  </div>
                  <!-- <form class="user" accept-charset="utf-8" action="/users/recuperarPass/<?php //echo $token;?>/" method="post">-->
                  <?= $this->Form->create("recuperarPass",["class" => "user","id"=>"form"]) ?>
                    <div class="form-group">
                      <input name="contrasenia" type="password" class="form-control form-control-user" id="contrasenia" placeholder="Ingrese contraseña...">
                    </div>
                    <div class="form-group">
                      <input name="contraseniaConfirm" type="password" class="form-control form-control-user" id="contraseniaConfirm" placeholder="Repita contraseña...">
                    </div>
                    <button type="button" class="btn btn-danger btn-user btn-block" onclick="guardar()">Aceptar</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="./registrar">Registrarme</a>
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

    </div>

  </div>

  <script type="text/javascript">    
    $(function () {        
        inicialize();
    });
    
    function inicialize()
    {
        $('#form').validate({
           rules: {              
               'contrasenia':{                   
                   required: true,
               },
               'contraseniaConfirm':{
                   required: true,
                   equalTo: "#contrasenia"
               }
           },
           messages: {
           	   'contrasenia': {
           	   	   required: "Ingrese contraseña"
               },
                'contraseniaConfirm': {
                   required: "Ingrese misma contraseña",
                   equalTo: "Debe ser igual a la contraseña"
               }
           },
           highlight: function(element) {
               $(element).closest('.control-group').removeClass('success').addClass('error');
           }
       });        
    }
    
    function guardar()
    {
        if($('#form').valid())
        {
           $('#form').submit();
        }
    }
    
 </script>

