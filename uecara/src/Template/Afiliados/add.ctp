<?php
use Cake\Core\Configure;
$url = Configure::read('App.fullBaseUrl').DIRHOST;
?>
<div class="users view large-10 medium-10 columns content">
	<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">
            	<i class="fas fa-user"></i> Nuevo Afiliado
            	<?php if ($user["perfil_id"] !==3) { ?><div style="float:right;">
				<?= $this->Html->link(__('Volver'), ['action' => 'index'], ['escape' => false]) ?>
				</div><?php } ?>
            </h6>
        </div>
    	<div class="card-body">
        	<?= $this->Form->create($afiliado, array('role' => 'form',"class" => "user")) ?>
        	<input type="hidden" name="baja" value="0" />
        	<div class="row">
              	<div class="col-sm-12">	
    				<div class="col-sm-3">
                        <label for="nro_afiliado" class="control-label">Nro Afiliado</label>
                  		<?php echo $this->Form->input('nro_afiliado',[ "label"=>false, "type"=>"text", "class" => "form-control", "id"=>"nro_afiliado", "value"=>"", "maxlength"=>6]); ?>
                  	</div>
                  	<div class="col-sm-9">
                        <label for="nomyape" class="control-label">Nombre y Apellido</label>
                        <?php echo $this->Form->input('nomyape',[ "label"=>false, "class" => "form-control", "value"=>""]); ?>      		
    				</div>
              	</div>       
			</div>
			<div class="row">
              	<div class="col-sm-12">	
    				<div class="col-sm-3">
                        <label for="fecha_nac" class="control-label">Fecha Nacimiento</label>
                  		<?php //echo $this->Form->input('fecha_nac',[ "label"=>false, "class" => "form-control", "value"=>date('Y-m-d'), "type"=>"date"]); ?>
                  		<input type="date" id="fecha_nac" name="fecha_nac" class="form-control" /> 
                  	</div>
                  	<div class="col-sm-3">
                        <label for="cuil" class="control-label">Cuil</label>
                        <?php echo $this->Form->input('cuil',[ "label"=>false, "class" => "form-control", "id"=>"cuil", "value"=>""]); ?>      		
    				</div>
    				<div class="col-sm-3">
                        <label for="telefono" class="control-label">Teléfono</label>
                        <?php echo $this->Form->input('telefono',[ "label"=>false, "class" => "form-control", "value"=>""]); ?>      		
    				</div>
              	</div>       
			</div>
			<div class="row">
              	<div class="col-sm-12">	
    				<div class="col-sm-6">
                        <label for="direccion" class="control-label">Dirección</label>
                  		<?php echo $this->Form->input('direccion',[ "label"=>false, "class" => "form-control", "value"=>""]); ?>
                  	</div>
                  	<div class="col-sm-6">
                        <label for="email" class="control-label">Email</label>
                        <?php echo $this->Form->input('email',[ "label"=>false, "class" => "form-control", "value"=>""]); ?>      		
    				</div>
              	</div>       
			</div>
			<div class="row">
              	<div class="col-sm-12">
              		<div class="col-sm-6">
                		<label for="tipo" class="col-sm-3 control-label">Empresa</label>
          				<?php echo $this->Form->input('empresa_id', ['options' => $empresas, "empty" => true, "label"=>false, "class" => "form-control", "id"=> "empresa"]); ?>
          				<!-- <select name="tipo_empresa_id">
                    		<option value=""></option>
                    		<?php /*if (!empty($empresas)) { 
                    		    foreach ($empresas as $empresa) {
                    		        echo '<option value="'.$empresa['id'].'"';
                    		        //if ($afiliado-empresa_id==$empresa['id']) echo " selected ";
                    		        echo '>'.$empresa['tipo'].'</option>';
                    		    }
                    		} */?>
                    	</select>-->
          			</div>
          			<div class="col-sm-6">
                		<label for="tipo" class="col-sm-4 control-label">Tipo de empresa</label>
          				<?php //echo $this->Form->input('tipo_empresa_id', ['options' => $tipos, "empty" => true, "label"=>false, "class" => "form-control", "id"=>"tipo_empresa"]); ?>
          				<input name="tipo" id="tipo" class="form-control" type="text" readonly style="background-color:transparent" />
          				<input name="tipo_empresa_id" id="tipo_empresa_id" class="form-control" type="hidden" />
          			</div>
          		</div>
          	</div>
          	<div class="row">
              	<div class="col-sm-12">
              		<div class="col-sm-4">
                		<label for="tipo_cont" class="col-sm-6 control-label">Tipo de contratación</label>
          				<select name="tipo_contratacion" class="form-control">
                    		<option value=""></option>
                    		<option value="temporario">Temporario</option>
                    		<option value="permanente">Permanente</option>
                    	</select>
          			</div>	
    				<div class="col-sm-3">
                        <label for="fecha_ingreso_afiliado" class="control-label">Fecha Ingreso al Afiliado</label>
                  		<?php //echo $this->Form->input('fecha_ingreso_afiliado',[ "label"=>false, "class" => "form-control", "value"=>"", "type"=>"date"]); ?>
                  		<input type="date" id="fecha_ingreso_afiliado" name="fecha_ingreso_afiliado" class="form-control" />
                  	</div>
                  	<div class="col-sm-3">
                        <label for="fecha_baja_sindicato" class="control-label">Fecha Baja del Sindicato</label>
                  		<?php //echo $this->Form->input('fecha_baja_sindicato',[ "label"=>false, "class" => "form-control", "value"=>"", "type"=>"date"]); ?>
                  		<input type="date" id="fecha_baja_sindicato" name="fecha_baja_sindicato" class="form-control" />
                  	</div>
            	</div>
           	</div>
          	<div class="row">
              	<div class="col-sm-12">	
    				<div class="col-sm-4">
                        <label for="telefono_empresa" class="control-label">Telefono Empresa</label>
                  		<?php echo $this->Form->input('telefono_empresa',[ "label"=>false, "class" => "form-control", "value"=>""]); ?>
                  	</div>
                  	<div class="col-sm-6">
                        <label for="email_empresa" class="control-label">Email Empresa</label>
                        <?php echo $this->Form->input('email_empresa',[ "label"=>false, "class" => "form-control", "value"=>""]); ?>      		
    				</div>
              	</div>       
			</div>
			<div class="row">
              	<div class="col-sm-12">	
    				<div class="col-sm-6">
                        <label for="observaciones" class="control-label">Observaciones</label>
                  		<?php echo $this->Form->input('observaciones',[ "label"=>false, "class" => "form-control", "value"=>""]); ?>
                  	</div>
                  	<div class="col-sm-4">
                        <label for="fecha_ingreso_empresa" class="control-label">Fecha Ingreso a la empresa</label>
                        <?php //echo $this->Form->input('fecha_ingreso_empresa',[ "label"=>false, "class" => "form-control", "value"=>"", "type"=>"date"]); ?>
                        <input type="date" id="fecha_ingreso_empresa" name="fecha_ingreso_empresa" class="form-control" />      		
    				</div>
              	</div>       
			</div>
			<div class="row">
              	<div class="col-sm-12">
              		<div class="col-sm-6">
                        <label for="categoria" class="control-label">Categoria de Empresa</label>
                        <?php echo $this->Form->input('categoria_id',[ "options" => $categorias, "empty" => true, "label"=>false, "class" => "form-control", "value"=>""]); ?>      		
    				</div>	
    				<div class="col-sm-4">
                        <label for="retiro_carnet" class="control-label">Retiro de carnet</label>
                  		<?php //echo $this->Form->input('retiro_carnet',[ "label"=>false, "class" => "form-control", "value"=>"1", "type"=>"radio", "options"=>[1=>"Si",0=>"No"], "style"=>["height:40px"]]); ?>
                  		<input type="radio" name="retiro_carnet" value="1"> Si  &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<input  type="radio" name="retiro_carnet" value="0" checked> No
                  	</div>
              	</div>       
			</div>
            <div class="offset-5 col-sm-10">
            	<?= $this->Form->button('<i class="fas fa-check"></i> '.__('Guardar'),["class" => "btn btn-success","style"=>"margin:0;"]) ?>
            	<?= $this->Html->link('<i class="fas fa-arrow-left"></i> '.__('Volver'), ['action' => 'index'], ['escape' => false,"class" => "btn btn-primary"]) ?>
            </div>
        	<?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script type="text/javascript">    
    $("#cuil, #nro_afiliado").bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode
        if (!(keyCode >= 48 && keyCode <= 57)) {
            $(".error").css("display", "inline");
            return false;
        } else {
            $(".error").css("display", "none");
        }
    });
    $('#empresa').change(function() {
     	if ($(this).val()!=0) {
     		$.ajax({
                url: "<?php echo $url?>/afiliados/getTipo/",
                type: 'POST',
                dataType: 'json',
                data: {empresa_id: $(this).val()},
                success: function (data) {
                	if (data.result) {
                		//$('#tipo_empresa').val(data.result['tipo_id']).change();
                		$('#tipo_empresa_id').val(data.result['tipo_id']);
                		$('#tipo').val(data.result['tipo']);
                	}
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }   
            });
       	} else {
       		$('#tipo_empresa_id').val('');
            $('#tipo').val('');
       	}
	});     
</script>


