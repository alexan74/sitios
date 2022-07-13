<div class="users view large-8 medium-8 columns content">
	<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">
            	<i class="fas fa-user"></i> Nuevo Perfil
            	<?php if ($user["perfil_id"] !==3) { ?><div style="float:right;">
				<?= $this->Html->link(__('Volver'), ['action' => 'index'], ['escape' => false]) ?>
				</div><?php } ?>
            </h6>
        </div>
        <div class="card-body">
            <?= $this->Form->create($perfil, array('role' => 'form',"class" => "perfil", "id" => "form")); ?>
        	<div class="form-group">
                <label for="a" class="col-sm-3 control-label">Nombre Perfil</label>
                <div class="col-sm-8">
          			<?php echo $this->Form->input('nombre_perfil',[ "label"=>false, "class" => "form-control"]);?>
          		</div>
          	</div>
          	<div class="form-group">
                <label for="a" class="col-sm-3 control-label">Nivel</label>
                <div class="col-sm-8">
          			<?php echo $this->Form->input('nivel',[ "label"=>false, "class" => "form-control"]);?>
          		</div>
          	</div> 
       	</div>
        <div class="form-group" > 
          	<div class="offset-4 col-sm-10">
            	<?= $this->Form->button('<i class="fas fa-check"></i> '.__('Guardar'),["onclick"=>"guardar()","class" => "btn btn-success","style"=>"margin:0;"]) ?>
            	<?= $this->Html->link('<i class="fas fa-arrow-left"></i> '.__('Volver'), ['action' => 'index'], ['escape' => false,"class" => "btn btn-primary"]) ?>
          	</div>
        </div>
        <?= $this->Form->end() ?>                
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
               'nombre_perfil':{                   
                   required: true      
               },
               'nivel':{
                   required: true
               }
           },
           messages: {
           	   'nombre_perfil': {
           	   	   required: "Ingrese nombre del perfil"  
               },
               'nivel': {
                   required: "Ingrese nivel"
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