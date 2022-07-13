<?php 
$usuario = $this->request->getSession()->read('Auth.User');
?>
<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?= __('Ver Tarea ') ?> <button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/tareas/index'"><i class="fas fa-undo"></i> Atrás</button></h4>
</div>
<fieldset class="form">
         
    <div class="col-sm-12 center">
    	<div class="row">
        	<div class="col-sm-12"> 
    			<label class="col-sm-2">Fecha</label>
               	<input disabled class="col-sm-8" type="date" name="fecha" value="<?php echo date('Y-m-d',strtotime($tarea->fecha));?>" />
            </div>
    	</div>
    	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Dirección</label>
                   	<input disabled type="text" name="direccion" id="direccion" autocomplete="off" class="col-sm-8" value="<?php echo $tarea->cliente->direccion;?>">
                </div>
        	</div>
    	<div class="row">
        	<div class="col-sm-12"> 
    			<label class="col-sm-2">Cliente</label>
               	<input disabled type="text" name="cliente" id="cliente" autocomplete="off" class="col-sm-8" value="<?php echo $tarea->cliente->razonsocial;?>">
               	<input type="hidden" name="cliente_id" id="cliente_id" value="<?php echo $tarea->cliente_id;?>">
            </div>
    	</div>
    	<div class="row">
        	<div class="col-sm-12"> 
    			<label class="col-sm-2">Empleado</label>
               	<input disabled type="text" name="empleado" id="empleado" autocomplete="off" class="col-sm-8" value="<?php echo $tarea->user->nombre." ".$tarea->user->apellido;?>">
               	<input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo $tarea->empleado_id;?>">
            </div>
    	</div>
        <div class="row">
        	<div class="col-sm-12"> 
    			<label class="col-sm-2">Servicios</label>
               	<select id="servicios-ids" name="servicios[_ids][]" class="col-sm-3" multiple="multiple" disabled style="min-height:auto;">             
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
               	<select id="tipos_tarea-ids" name="tipos_tarea[_ids][]" class="col-sm-3" multiple="multiple" disabled style="min-height:auto;">             
                	<?php foreach ($tiposTarea as $tipo): ?>
                    <option value="<?php echo $tipo->id; ?>"
                    <?php if (in_array($tipo->id,$lista_tipos)) echo " selected ";?>
                    ><?php echo $tipo->descripcion; ?></option>
                	<?php endforeach; ?>
            	</select>
            </div>
    	</div>
    	<?php if (($tarea->tipo_pago_id==1 && $tarea->pagado==0 && $usuario['tipo_usuario']==2) || $usuario['tipo_usuario']!=2) { ?>
    	<div class="row">
        	<div class="col-sm-12"> 
    			<label class="col-sm-2">Cobrar $</label>
               	<input disabled class="col-sm-8" type="text" name="costo" placeholder="0,00" value="<?php echo number_format($tarea->costo,2,',','.');?>" />
            </div>
    	</div>
    	<div class="row">
        	<div class="col-sm-12"> 
    			<label class="col-sm-2">Tipo de pago</label>
               	<select disabled name="tipo_pago_id" class="col-sm-8">             
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
    			<input name="pagado" type="checkbox" value="1" <?php if ($tarea->pagado) echo " checked ";?> disabled>
            </div>
    	</div>
    	<?php } ?>
    	<?php if ($usuario['tipo_usuario']!=2) { ?>
    	<div class="row">
        	<div class="col-sm-12"> 
    			<label class="col-sm-2">Tipo de factura</label>
               	<select disabled name="tipo_factura_id" class="col-sm-8">
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
               	<input class="col-sm-8" type="number" name="nro_factura" maxlength="20" value="<?php echo $tarea->nro_factura;?>" disabled />
            </div>
    	</div>
    	<?php } ?>
    	<div class="row">
        	<div class="col-sm-5"> 
    			<label class="col-sm-5" style="padding-left: 0px">Hora (Desde)</label>
    			<input class="col-sm-4" type="time" name="hora_desde" min="00:00" max="23:59" value="<?php echo date('H:i',strtotime($tarea->hora_desde));?>" disabled />
            </div>
            <div class="col-sm-5"> 
    			<label class="col-sm-5" style="padding-left: 0px">Hora (Hasta)</label>
    			<input class="col-sm-4" type="time" name="hora_hasta" min="00:00" max="23:59" value="<?php echo date('H:i',strtotime($tarea->hora_hasta));?>" disabled />
            </div>
    	</div>
    	<div class="row">
    	<div class="col-sm-12"> 
			<label class="col-sm-2">Estado de servicio</label>
           	<select disabled name="estado_servicio_id" class="col-sm-8">             
            	<option value=""></option>
            	<?php foreach ($estadosServicio as $estado): ?>
                <option value="<?php echo $estado->id; ?>"
                <?php if ($tarea->estado_servicio_id==$estado->id) echo " selected ";?>
                ><?php echo $estado->descripcion; ?></option>
            	<?php endforeach; ?>
        	</select>
        </div>
	</div>
    </div>
</fieldset>
<style type="text/css">
select[multiple] {
  min-height: auto;
}
</style>
<script type="text/javascript">
    $(function () {
    	$('#servicios-ids').multiselect('destroy');
    });
</script>
