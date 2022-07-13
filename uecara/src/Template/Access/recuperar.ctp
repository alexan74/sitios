
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
                    <h1 class="h4 text-gray-900 mb-2">Recuperar Contraseña</h1>
                    <p class="mb-4">Ingrese su dirección de correo electrónico a continuación, le enviaremos un enlace para restablecer su contraseña!</p>
                  </div>
                  <!-- <form id="form" class="user" accept-charset="utf-8" action="recuperar" method="post">-->
                  <?= $this->Form->create("recuperar",["class" => "user","id"=>"form"]) ?>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Ingrese email...">
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
               'email':{                   
                   required: true,
                   email:true
               },
           },
           messages: {
           	   'email': {
           	   	   required: "Ingrese email",
           	   	   email: "Ingrese email valido" 	   
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
