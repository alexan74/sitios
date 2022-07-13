<div class="users view large-8 medium-8 columns content">
	<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">
            	<i class="fas fa-user"></i> Editar Usuario
            	<?php if ($user["perfil_id"] !==3) { ?><div style="float:right;">
				<?= $this->Html->link(__('Volver'), ['controller'=>'users','action' => 'index'], ['escape' => false]) ?>
				</div><?php } ?>
            </h6>
        </div>
        <div class="card-body">
        <?= $this->Form->create($user, array('role' => 'form',"class" => "user", "id"=>"form")) ?>
			<div class="form-group">
                <label for="a" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-8">
                    <?php echo $this->Form->input('email',["label"=>false, "class" => "form-control"]);?>
                 </div>
            </div>
            <!-- <div class="form-group" >
                <label for="a" class="col-sm-3 control-label">Contraseña</label>
                <div class="col-sm-8">
          			<?php echo $this->Form->input('password',[ "label"=>false, "class" => "form-control"]); ?>
          		</div>
            </div>-->
            <div class="form-group" >
                <label for="a" class="col-sm-3 control-label">Nombre</label>
                <div class="col-sm-8">
          			<?php echo $this->Form->input('nombre',[ "label"=>false, "class" => "form-control"]); ?>
          		</div>
            </div>
            <div class="form-group" >
                <label for="a" class="col-sm-3 control-label">Apellido</label>
                <div class="col-sm-8">
          			<?php echo $this->Form->input('apellido',[ "label"=>false, "class" => "form-control"]); ?>
          		</div>
            </div>
            <div class="form-group" >
                <label for="a" class="col-sm-3 control-label">Perfil</label>
                <div class="col-sm-8">
          			<?php echo $this->Form->input('perfil_id', ['options' => $perfil, "disabled" => array('1'), "empty" => true, "label"=>false, "class" => "form-control"]); ?>
          		</div>
            </div>
            <div class="form-group" >
                <label for="a" class="col-sm-3 control-label">Activo</label>
                <div class="col-sm-8">
          			<?php echo $this->Form->input('activo',[ "label"=>false, "class" => "fleft", "style"=>"width:auto;"]); ?>
          		</div>
            </div>
            <div class="form-group" >
        		<div class="offset-4 col-sm-10">
                    <?= $this->Form->button('<i class="fas fa-check"></i> '.__('Guardar'),["onclick"=>"guardar()","class" => "btn btn-success", "style"=>"margin:0;"]) ?>
                    <?= $this->Html->link('<i class="fas fa-arrow-left"></i> '.__('Volver'), ['action' => 'index'], ['escape' => false,"class" => "btn btn-danger"]) ?>
                </div>
            </div>
        <?= $this->Form->end() ?>
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
               /*'password':{
                   required: true
               },*/
               'nombre':{
                   required: true
               },
               'apellido':{
                   required: true
               },
               'perfil_id':{
                   required: true
               }
           },
           messages: {
           	   'email': {
           	   	   required: "Ingrese email",
           	   	   email: "Ingrese email valido"
               },
               /*'password': {
                   required: "Ingrese contraseña"
               },*/
               'nombre': {
                   required: "Ingrese nombre"
               },
               'apellido': {
                   required: "Ingrese apellido"
               },
               'perfil_id': {
                   required: "Seleccione perfil"
               },
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
