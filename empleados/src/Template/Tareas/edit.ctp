<?php 
$usuario = $this->request->getSession()->read('Auth.User');
$disabled = ($usuario['tipo_usuario']==2)?" disabled ":"";
?>
<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?= __('Acción en Tarea ') ?> <button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/tareas/index'"><i class="fas fa-undo"></i> Atrás</button></h4>
</div>
<fieldset class="form">
    <form id="form" method="post" accept-charset="utf-8" action="/tareas/edit/<?php echo $tarea->id;?>">        
        <div class="col-sm-12 center">
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Fecha</label>
                   	<input class="col-sm-8" type="date" name="fecha" value="<?php echo date('Y-m-d',strtotime($tarea->fecha));?>" <?=$disabled;?> />
                </div>
			</div>
			<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Dirección</label>
                   	<input required="required" type="text" name="direccion" id="direccion" autocomplete="off" class="col-sm-8" value="<?php echo $tarea->cliente->direccion;?>" <?=$disabled;?>>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Cliente</label>
                   	<input required="required" type="text" name="cliente" id="cliente" autocomplete="off" class="col-sm-8" value="<?php echo $tarea->cliente->razonsocial;?>" <?=$disabled;?>>
                   	<input type="hidden" name="cliente_id" id="cliente_id" value="<?php echo $tarea->cliente_id;?>">
                </div>
        	</div>
        	<?php if ($usuario['tipo_usuario']!=2) {?>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Empleado</label>
                   	<!-- <input required="required" type="text" name="empleado" id="empleado" autocomplete="off" class="col-sm-8" value="<?php //echo $tarea->user->nombre." ".$tarea->user->apellido;?>" <?php //=$disabled;?>>
                   	<input type="hidden" name="empleado_id" id="empleado_id" value="<?php //echo $tarea->empleado_id;?>">-->
                   	<select id="empleado_id" name="empleado_id" class="col-sm-8">
                   		<option value=""></option>             
                    	<?php foreach ($empleados as $empleado): ?>
                        <option value="<?php echo $empleado->id; ?>"
                            <?php if ($tarea->empleado_id == $empleado->id) echo " selected ";?>
                        ><?php echo $empleado->nombre." ".$empleado->apellido; ?></option>
                    	<?php endforeach; ?>
                	</select>
                </div>
        	</div>
        	<?php } ?>
            <div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Servicios</label>
                   	<select id="servicios-ids" name="servicios[_ids][]" class="col-sm-8" multiple="multiple" <?=$disabled;?>>             
                    <?php foreach ($servicios as $servicio): ?>
                        <option value="<?php echo $servicio->id; ?>"
                        <?php if (in_array($servicio->id,$lista_servicios)) echo " selected "; ?>
                        ><?php echo $servicio->descripcion; ?></option>
                    <?php endforeach; ?>
                	</select>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Tipos de tarea</label>
                   	<select id="tipos_tarea-ids" name="tipos_tarea[_ids][]" class="col-sm-8" multiple="multiple" <?=$disabled;?>>             
                    	<?php foreach ($tiposTarea as $tipo): ?>
                        <option value="<?php echo $tipo->id; ?>"
                        <?php if (in_array($tipo->id,$lista_tipos)) echo " selected ";?>
                        ><?php echo $tipo->descripcion; ?></option>
                    	<?php endforeach; ?>
                	</select>
                </div>
        	</div>
        	<?php if (($tarea->tipo_pago_id==1 && $tarea->pagado==0 && $usuario['tipo_usuario']==2 && ($tarea->estado_servicio_id != 2 || $tarea->estado_servicio_id != 4)) || 
        	    $usuario['tipo_usuario']!=2) { ?>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Cobrar $</label> 			
                   	<input class="col-sm-8" type="number" name="costo" id="costo" step=".01" placeholder="0,00" value="<?php echo $tarea->costo;?>" <?=$disabled;?> />
                </div>
        	</div>
        	<?php } else { ?>
        	    <input type="hidden" name="costo" id="costo" value="<?php echo ($tarea->costo)?$tarea->costo:'0.00';?>">
        	<?php }?>
        	<?php if (($usuario['tipo_usuario']==2 && ($tarea->tipo_pago_id==1 && !$tarea->pagado)) || $usuario['tipo_usuario']!=2) { ?>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Tipo de pago</label>
                   	<select required="required" name="tipo_pago_id" class="col-sm-8" id="tipo_pago" <?=$disabled;?>>             
                    	<option value=""></option>
                    	<?php foreach ($tiposPago as $tipo): ?>
                        <option value="<?php echo $tipo->id; ?>"
                        <?php if ($tarea->tipo_pago_id==$tipo->id) echo " selected ";?>
                        ><?php echo $tipo->descripcion; ?></option>
                    	<?php endforeach; ?>
                	</select>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Pagado</label>
        			<input id="pagado" name="pagado" type="checkbox" value="1" <?php if ($tarea->pagado) echo " checked ";?> <?=$disabled;?>>
                </div>
        	</div>
        	<?php } ?>
        	<?php if ($usuario['tipo_usuario']!=2) { ?>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Tipo de factura</label>
                   	<select required="required" name="tipo_factura_id" class="col-sm-8" <?=$disabled;?>>
                   		<option value=""></option>             
                    	<?php foreach ($tiposFactura as $tipo): ?>
                        <option value="<?php echo $tipo->id; ?>"
                         <?php if ($tarea->tipo_factura_id==$tipo->id) echo " selected ";?>
                        ><?php echo $tipo->descripcion; ?></option>
                    	<?php endforeach; ?>
                	</select>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Nro Factura</label>
                   	<input class="col-sm-8" type="number" name="nro_factura" maxlength="20" value="<?php echo $tarea->nro_factura;?>" <?=$disabled;?>/>
                </div>
        	</div>
        	<?php } ?>
        	<div class="row">
            	<div class="col-sm-5"> 
        			<label class="col-sm-5" style="padding-left: 0px">Hora (Desde)</label>
                   	<input class="col-sm-4" type="time" name="hora_desde" min="00:00" max="23:59" value="<?php echo date('H:i',strtotime($tarea->hora_desde));?>" <?=$disabled;?>/>
                </div>
               	<div class="col-sm-5"> 
        			<label class="col-sm-5" style="padding-left: 0px">Hora (Hasta)</label>
                   	<input class="col-sm-4" type="time" name="hora_hasta" min="00:00" max="23:59" value="<?php echo date('H:i',strtotime($tarea->hora_hasta));?>" <?=$disabled;?>/>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-5"> 
        			<label class="col-sm-4">Estado de servicio</label>
                   	<select required="required" name="estado_servicio_id" class="col-sm-6" id="estado" <?php if ($usuario['tipo_usuario']==2 && ($tarea->estado_servicio_id==2 || $tarea->estado_servicio_id==4)) echo " disabled ";?>>             
                    	<option value=""></option>
                    	<?php foreach ($estadosServicio as $estado): ?>
                            <option value="<?php echo $estado->id; ?>"
                            <?php if ($tarea->estado_servicio_id==$estado->id) echo " selected ";?> 
                            <?php 
                                if($tarea->estado_servicio_id==3 && ($estado->id == 3 || $estado->id == 4)) echo " disabled ";
                                elseif($tarea->estado_servicio_id==1 && ($estado->id == 1 || $estado->id == 3)) echo " disabled ";
                            ?>
                            ><?php echo $estado->descripcion; ?></option>
                    	<?php endforeach; ?>
                	</select>
                </div>
                <div class="col-sm-6 observaciones"> 
        			<label class="col-sm-2">Observaciones</label>
        			<input type="text" name="observaciones" id="observaciones" autocomplete="off" class="col-sm-8" value="<?php echo $tarea->observaciones;?>" <?=$disabled;?> >
        		</div>
        	</div>
        </div>
        <br />
        <a id="btn_viatico" href="/viaticos/add/<?php echo $tarea->id;?>" class="btn btn-primary tiny pull-right" style="margin-left:20px;display:none;"><i class="fas fa-plus"></i> VIATICO</a>
        <?php if ($tarea->estado_servicio_id!=2 && $tarea->estado_servicio_id!=4) { ?><button type="button" id="guardar" class="btn btn-success tiny pull-right"><i class="fas fa-save"></i> GUARDAR</button> <?php } ?>
        
     </form>  
</fieldset>
<style type="text/css">
select[multiple] {
  min-height: auto;
}
</style>

<script type="text/javascript">
    $(function () {
    	if ($('#estado').val()==1 &&  $('#tipo_pago').val() == 1) {
    		<?php if ($usuario['tipo_usuario']==2){ ?>
        	//$('#btn_viatico').show();
        	<?php } ?>
        } else {
        	//$('#btn_viatico').hide();
        }
        if ($('#estado').val()==2) {
        	$('.observaciones').show();
        } else {
        	$('.observaciones').hide();
        }
    	$('#estado').change(function() {
            if ($(this).val()==4 <?= ($usuario['tipo_usuario']==2)?'|| $(this).val()==1':''?>)
            	$('#costo').prop('disabled', true);
            else
            	$('#costo').prop('disabled', false);
            if ($(this).val()==1 &&  $('#tipo_pago').val() == 1) {
            	<?php if ($usuario['tipo_usuario']==2){ ?>
            	//$('#btn_viatico').show();
            	<?php } ?>
            } else {
            	//$('#btn_viatico').hide();
            }
            if ($(this).val()==2) {
        		$('.observaciones').show();
        		$('#observaciones').prop('disabled', false);
            } else {
            	$('#observaciones').prop('disabled', true);
            	$('.observaciones').hide();
            }
        });
        
        $('#tipo_pago').change(function() {
            if ($(this).val()==1 && $('#estado').val() == 1) {
            	<?php if ($usuario['tipo_usuario']==2){ ?>
            	$('#btn_viatico').show();
            	<?php } ?>
            } else {
            	$('#btn_viatico').hide();
            }
        });
    	<?php if ($usuario['tipo_usuario']!=2) { ?>
    	$('#servicios-ids').multiselect({
             nonSelectedText: 'Lista de Servicios', 
        });
        
        $('#tipos_tarea-ids').multiselect({
             nonSelectedText: 'Lista de tipos de tarea'
        });
        <?php } ?>
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
                        console.log(data);
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
            	console.log(ui);      	                	
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
                        console.log(data);
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
        $('#guardar').click(function(e) {
        	e.preventDefault();
       		e.stopPropagation();
        	if ($('#estado').val() == 4 && $('#tipo_pago').val() == 1 && !$('#pagado').is(":checked")) {
            	bootbox.confirm({
                    message: "¿El cliente abono el costo total del servicio?",
                    buttons: {
                        confirm: {
                            label: 'Si',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {
                        if (result) {
                        	$('#pagado').val(1);
                        	$('#pagado').prop('checked', true);
                        	$('#form').submit();
                       	}
                    }
        		});
       		} else {
       			$('#form').submit();
       		}
       		
       	});
    });
    
</script>