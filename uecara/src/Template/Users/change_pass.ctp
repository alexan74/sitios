<div class="perfil view large-10 medium-8 columns content">
	<?php
	$user = $this->request->getSession()->read('Auth.User');
	//debug($user);
	?>
	<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary"><i class="fas fa-key"></i> Cambio contraseña (Usuario: </b><?php echo @$user['nombre']." ".@$user['apellido'];?>)</h6>
        </div>
        <div class="card-body">
            <?= $this->Form->create("changePass",["class" => "user","id"=>"form"]); ?>
                <div class="form-group" id="contrasenia-group">
                    <label for="a" class="col-sm-4 control-label">Ingrese contraseña actual</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="contraseniaActual" id="contraseniaActual" placeholder="Ingrese contraseña actual">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre" class="col-sm-4 control-label">Nueva contraseña</label>
                    <div class="col-sm-8">                        
                        <input type="password" name="contraseniaNueva" id="contraseniaNueva" placeholder="Nueva contraseña" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="apellido" class="col-sm-4 control-label">Repita nueva contraseña</label>
                    <div class="col-sm-8">
                        <input type="password" name="contraseniaNuevaConfirm" id="contraseniaNuevaConfirm" placeholder="Repita nueva contraseña" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-10">
                        <button type="button" class="btn btn-danger" onclick="guardar()">Guardar</button>
                    </div>
                </div>                
            <?= $this->Form->end(); ?>
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
               'contraseniaActual':{                   
                   required: true
               },
               'contraseniaNueva':{
                   required: true
               },
               'contraseniaNuevaConfirm':{
                   required: true,
                   equalTo: "#contraseniaNueva"
               }
           },
           messages: {
           	   'contraseniaActual': {
           	   	   required: "Ingrese contraseña actual"
               },
               'contraseniaNueva': {
                   required: "Ingrese contraseña nueva"
               },
                'contraseniaNuevaConfirm': {
                   required: "Ingrese misma contraseña nueva",
                   equalTo: "Debe ser igual a la contraseña nueva"
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
        	<?php if (!empty($user)) { ?>
            bootbox.confirm("¿Está seguro de que desea cambiar contraseña de usuario?", function(result) {
                if (result)
                {
                    $('#form').submit();
                }
           });
           <?php } ?> 
        }
    }
</script>