<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?= __('Nueva Tarea ') ?> <button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/tareas/index'"><i class="fas fa-undo"></i> Atrás</button></h4>
</div>
<fieldset class="form">
    <form method="post" accept-charset="utf-8" action="/tareas/add/">        
        <div class="col-sm-12 center">
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Fecha</label>
                   	<input required="required" class="col-sm-8" type="date" name="fecha" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Dirección</label>
                   	<input required="required" type="text" name="direccion" id="direccion" autocomplete="off" class="col-sm-8">
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Cliente</label>
                   	<input required="required" type="text" name="cliente" id="cliente" autocomplete="off" class="col-sm-8">
                   	<input type="hidden" name="cliente_id" id="cliente_id">
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Empleado</label>
                   	<!-- <input required="required" type="text" name="empleado" id="empleado" autocomplete="off" class="col-sm-8">
                   	<input type="hidden" name="empleado_id" id="empleado_id">-->
                   	<select id="empleado_id" name="empleado_id" class="col-sm-8">
                   		<option value=""></option>             
                    	<?php foreach ($empleados as $empleado): ?>
                        <option value="<?php echo $empleado->id; ?>"><?php echo $empleado->nombre." ".$empleado->apellido; ?></option>
                    	<?php endforeach; ?>
                	</select>
                </div>
        	</div>
            <div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Servicios</label>
                   	<select id="servicios-ids" name="servicios[_ids][]" class="col-sm-8" multiple="multiple" >             
                    <?php foreach ($servicios as $servicio): ?>
                        <option value="<?php echo $servicio->id; ?>"><?php echo $servicio->descripcion; ?></option>
                    <?php endforeach; ?>
                	</select>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Tipos de tarea</label>
                   	<select id="tipos_tarea-ids" name="tipos_tarea[_ids][]" class="col-sm-8" multiple="multiple">             
                    	<?php foreach ($tiposTarea as $tipo): ?>
                        <option value="<?php echo $tipo->id; ?>"><?php echo $tipo->descripcion; ?></option>
                    	<?php endforeach; ?>
                	</select>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Cobrar $</label>
                   	<input required="required" class="col-sm-8" type="number" name="costo" step=".01" placeholder="0,00" id="costo" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Tipo de pago</label>
                   	<select required="required" name="tipo_pago_id" class="col-sm-8">             
                    	<option value=""></option>
                    	<?php foreach ($tiposPago as $tipo): ?>
                        <option value="<?php echo $tipo->id; ?>"><?php echo $tipo->descripcion; ?></option>
                    	<?php endforeach; ?>
                	</select>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Pagado</label>
        			<input name="pagado" type="checkbox" value="1">
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Tipo de factura</label>
                   	<select required="required" name="tipo_factura_id" class="col-sm-8">
                   		<option value=""></option>             
                    	<?php foreach ($tiposFactura as $tipo): ?>
                        <option value="<?php echo $tipo->id; ?>"><?php echo $tipo->descripcion; ?></option>
                    	<?php endforeach; ?>
                	</select>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Nro Factura</label>
                   	<input class="col-sm-8" type="number" name="nro_factura" maxlength="20"/>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-5"> 
        			<label class="col-sm-5" style="padding-left: 0px">Hora (Desde)</label>
                   	<input class="col-sm-4" type="time" name="hora_desde" min="00:00" max="23:59" />
                </div>
                <div class="col-sm-5"> 
        			<label class="col-sm-5" style="padding-left: 0px">Hora (Hasta)</label>
                   	<input class="col-sm-4" type="time" name="hora_hasta" min="00:00" max="23:59" />
                </div>
        	</div>
        </div>
        <br />
        <button type="submit" class="btn btn-success tiny pull-right"><i class="fas fa-save"></i> GUARDAR</button>
     </form>  
</fieldset>
<style type="text/css">
select[multiple] {
  min-height: auto;
}
</style>
<script type="text/javascript">
    $( document ).ready(function() {
    	$('#servicios-ids').multiselect({
             nonSelectedText: 'Lista de Servicios', 
        });
        
        $('#tipos_tarea-ids').multiselect({
             nonSelectedText: 'Lista de tipos de tarea'
        });
            
        $("#costo").keydown(function(e) {
        	if (e.keyCode == 188 || e.charCode == 188) return false;
        });
        
        $("#cliente").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "/tareas/getClientes/",
                    type: 'POST',
                    dataType: 'json',
                    data: {valor: request.term, direccion: $('#direccion').val()},
                    success: function (data) {
                    	$('#cliente').val();                       
                        response($.map(data, function(item) {
                            return {
                                label: item.label,                                
                                value: item.label,
                                id: item.value
                            };
                        }));
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    }   
                });
            },
            minLength: 2,
            select: function(event, ui) {      	                	
                //$('#cliente').val(ui.item.label);
                $('#cliente_id').val(ui.item.id);
            }
        });
        /*$("#empleado").autocomplete({
            source: function (request, response) {
                 
                $.ajax({
                    url: "/tareas/getEmpleados/",
                    type: 'POST',
                    dataType: 'json',
                    data: {valor: request.term},
                    success: function (data) {                       
                        response($.map(data, function(item) {
                            return {
                                label: item.label,                                
                                value: item.label,
                                id: item.value
                            };
                        }));
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    }   
                });
            },
            minLength: 2,
            select: function(event, ui) {         	                	
                //$('#empleado').val(ui.item.label);
                $('#empleado_id').val(ui.item.id);
            }
        });*/
        
        $("#direccion").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "/tareas/getDirecciones/",
                    type: 'POST',
                    dataType: 'json',
                    data: {valor: request.term},
                    success: function (data) {                       
                        response($.map(data, function(item) {
                            return {
                                label: item.label,                                
                                value: item.label,
                                id: item.value,
                                cliente_id: item.cliente_id,
                                cliente: item.cliente
                            };
                        }));
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    	alert("Status: " + textStatus); 
                    	alert("Error: " + errorThrown); 
                    }   
                });
            },
            minLength: 2,
            select: function(event, ui) {         	                	
                $('#cliente').val(ui.item.cliente);
                $('#cliente_id').val(ui.item.cliente_id);
            }
            
        });
    });
</script>