<div class="users view columns content">
	<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">
            	<i class="fas fa-user"></i> Nueva Empresa
            	<div style="float:right;">
				<?= $this->Html->link(__('Volver'), ['action' => 'index'], ['escape' => false]) ?>
				</div>
            </h6>
        </div>
        <div class="card-body">
        	<?= $this->Form->create($empresa, array('role' => 'form',"class" => "user")) ?>
          	<div class="row">
              	<div class="col-sm-12">	
    				<div class="col-sm-9">
                        <label for="cuit" class="control-label">Cuit</label>
                  		<?php echo $this->Form->input('cuit',[ "label"=>false, "class" => "form-control", "id"=>"cuit","value"=>""]); ?>
                  	</div>
                  	<div class="col-sm-3">
                        <label for="fecha" class="control-label">Fecha</label>
                  		<input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo date('Y-m-d');?>" disabled /> 
    				</div>
              	</div>       
			</div>
			<div class="row">
              	<div class="col-sm-12">
              		<div class="col-sm-12">
                        <label for="denom_social" class="control-label">Denominación Social</label>
                  		<?php echo $this->Form->input('denom_social',[ "label"=>false, "class" => "form-control"]); ?>
                  	</div>
              	</div>       
			</div>
            <div class="row">
              	<div class="col-sm-12">	
    				<div class="col-sm-6">
                        <label for="calle" class="control-label">Calle</label>
                  		<?php echo $this->Form->input('calle',[ "label"=>false, "class" => "form-control"]); ?>
                  	</div>
                  	<div class="col-sm-2">
                        <label for="numero" class="control-label">Numero</label>
                  		<?php echo $this->Form->input('numero',[ "label"=>false, "class" => "form-control"]); ?>
    				</div>
    				<div class="col-sm-2">
                        <label for="piso" class="control-label">Piso</label>
                  		<?php echo $this->Form->input('piso',[ "label"=>false, "class" => "form-control"]); ?>
    				</div>
    				<div class="col-sm-2">
                        <label for="dpto" class="control-label">Dpto</label>
                  		<?php echo $this->Form->input('dpto',[ "label"=>false, "class" => "form-control"]); ?>
    				</div>	
              	</div>       
			</div>
			<div class="row">
              	<div class="col-sm-12">	
    				<div class="col-sm-4">
                        <label for="barrio" class="control-label">Barrio</label>
                  		<?php echo $this->Form->input('barrio',[ "label"=>false, "class" => "form-control"]); ?>
                  	</div>
                  	<div class="col-sm-4">
                        <label for="localidad" class="control-label">Localidad</label>
                  		<?php echo $this->Form->input('localidad',[ "label"=>false, "class" => "form-control"]); ?>
    				</div>
    				<div class="col-sm-4">
                        <label for="provincia" class="control-label">Provincia</label>
                  		<?php echo $this->Form->input('provincia',[ "label"=>false, "class" => "form-control"]); ?>
    				</div>
              	</div>       
			</div>
			<div class="row">
              	<div class="col-sm-12">	
    				<div class="col-sm-4">
                        <label for="codpos" class="control-label">Cod. Postal</label>
                  		<?php echo $this->Form->input('codpos',[ "label"=>false, "class" => "form-control"]); ?>
                  	</div>
                  	<div class="col-sm-4">
                        <label for="telefono" class="control-label">Teléfono</label>
                  		<?php echo $this->Form->input('telefono',[ "label"=>false, "class" => "form-control"]); ?>
    				</div>
    				<div class="col-sm-4">
                        <label for="fax" class="control-label">Fax</label>
                  		<?php echo $this->Form->input('fax',[ "label"=>false, "class" => "form-control"]); ?>
    				</div>
              	</div>       
			</div>
			<div class="row">
              	<div class="col-sm-12">
              		<div class="col-sm-12">
                        <label for="email" class="control-label">Email</label>
                  		<?php echo $this->Form->input('email',[ "label"=>false, "class" => "form-control"]); ?>
                  	</div>
              	</div>       
			</div>
			<div class="row">
              	<div class="col-sm-12">	
    				<div class="col-sm-4">
                        <label for="cant_sucurs" class="control-label">Cantidad de sucursales</label>
                  		<?php echo $this->Form->input('cant_sucurs',[ "label"=>false, "class" => "form-control col-sm-5"]); ?>
                  	</div>
                  	<div class="col-sm-4">
                        <label for="total_emp" class="control-label">Total de empleados</label>
                  		<?php echo $this->Form->input('total_emp',[ "label"=>false, "class" => "form-control col-sm-5"]); ?>
    				</div>
              	</div>       
			</div>
			<div class="row">
              	<div class="col-sm-12">
				<h4><?= __('Nominas') ?></h4>
    				<table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        	<tr>
                        		<th width="25%">Apellido</th>
                        		<th width="25%">Nombre</th>
                        		<th width="25%">Categoria</th>
                        		<th width="15%">Cuota Sindical</th>
                        		<th width="10%"></th>
                     		</tr>	
                        </thead>
                        <tbody>
                          	<tr>
                                <td><input name="nominas[0][apellido]" type="text"/></td>
                                <td><input name="nominas[0][nombre]" type="text"/></td>
                                <td><input name="nominas[0][categoria]" type="text"/></td>
                                <td class="tcenter"><input name="nominas[0][cuota_sindical]" type="checkbox" value="1" /></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="borrar(this)"><i class="fas fa-times-circle"> </i></button></td>
                                <td></td>
                        	</tr>
                        </tbody>
                    </table>
                    <div class="tright"><input class="btn btn-primary" type="button" value="+ Nomina" id="btn_nomina" /></div>
               	</div>
            </div>
          	<div class="offset-4 col-sm-8">
            	<?= $this->Form->button('<i class="fas fa-check"></i> '.__('Guardar'),["class" => "btn btn-success","style"=>"margin:0;"]) ?>
            	<?= $this->Html->link('<i class="fas fa-arrow-left"></i> '.__('Volver'), ['action' => 'index'], ['escape' => false,"class" => "btn btn-danger"]) ?>
          	</div>
        	<?= $this->Form->end() ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#btn_nomina").click('input',function() {
		/*var row = '<tr><td><input name="nominas[0][apellido]" type="text"/></td>'+
            '<td><input name="nominas[0][nombre]" type="text"/></td>'+
            '<td><input name="nominas[0][categoria]" type="text"/></td>'+
            '<td class="tcenter"><input name="nominas[0][cuota_sindical]" type="checkbox" value="1" /></td>'+
            '<td><button type="button" class="btn btn-sm btn-danger" onclick="borrar(this)"><i class="fas fa-times-circle"> </i></button></td></tr>';

		$('tbody').append(row);*/
		
		$("tbody tr:last-child").clone().appendTo('tbody');
		$('table tbody tr:last-child input').each(function() {
			if ($(this).is(':checkbox')) {
				if ($(this).is(':checked')) $(this).prop('checked',false);
			} else {
				$(this).val('');
			}
    		var nameAttr = $(this).attr('name');
            var newIndex = parseInt(nameAttr.replace(/[^\d]/g, ''))+1;
            $(this).attr('name',nameAttr.replace(/\d/,newIndex));
        });
    });
    
    $("#cuit").bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode
        if (!(keyCode >= 48 && keyCode <= 57)) {
            $(".error").css("display", "inline");
            return false;
        } else {
            $(".error").css("display", "none");
        }
    });
    
    function borrar(control) {
       $(control).closest('tr').remove();
       var n=0;
       $('table tbody tr').each(function() {
       		$(this).find("td > input").each(function() {
       			//alert($(this).attr('name'));
        		var nameAttr = $(this).attr('name');
                //var newIndex = parseInt(nameAttr.replace(/[^\d]/g, ''))+n;
                $(this).attr('name',nameAttr.replace(/\d/,n));
            });
            n = n + 1;
        });
    };
</script>
