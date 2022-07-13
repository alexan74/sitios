<?php 
$usuario = $this->request->getSession()->read('Auth.User');
$disabled = ($usuario['tipo_usuario']==2)?" disabled ":"";
if (!empty($tarea)) {
    $empleado = $tarea->empleado_id;
} elseif ($usuario['tipo_usuario']==2) {
    $empleado = $usuario['id'];
}
?>
<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?= __('Nuevo Viatico ') ?> 
	<button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='<?php echo (!empty($tarea->id))?'/tareas/index':'/viaticos/index';?>'"><i class="fas fa-undo"></i> Atrás</button>
	</h4>
</div>
<fieldset class="form">
    <form method="post" accept-charset="utf-8" action="/viaticos/add/<?php echo (!empty($tarea))?$tarea->id:"";?>">        
        <input type="hidden" name="empleado_id" value="<?php echo $empleado;?>" />
        <input type="hidden" name="tarea_id" value="<?php echo @$tarea->id;?>" />
        <div class="col-sm-12 center">
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Fecha</label>
                   	<input required="required" class="col-sm-8" type="date" name="fecha" value="<?php echo date('Y-m-d');?>" disabled/>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Descripción</label>
                   	<input required="required" type="text" name="descripcion" id="descripcion" autocomplete="off" class="col-sm-8"
                   	value="<?php echo (!empty($tarea))?$tarea->cliente->razonsocial." - ".$tarea->cliente->direccion." - ".date('d/m/Y H:i:s'):"";?>" <?= (!empty($tarea->id))?" disabled ": "";?>/>
                </div>
        	</div>
        	
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Valor $</label>
                   	<input required="required" class="col-sm-8" type="number" name="valor" step=".01" placeholder="0.00" id="valor" />
                </div>
        	</div>
        	<?php if ($usuario['tipo_usuario']!=2) { ?>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Carga</label>
        			<input name="carga" type="radio" value="1" <?= (!empty($tarea->id))?" checked ":"";?>> Automatico&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<input name="carga" type="radio" value="0" <?= (empty($tarea->id))?" checked ":"";?>>Manual
                </div>
        	</div>
        	<?php } else { ?>
        	   <input name="carga" type="hidden" value="<?= (!empty($tarea->id))?1:0;?>">
        	<?php  } ?>
        	<?php if ($usuario['tipo_usuario']!=2) { ?>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Pagado</label>
        			<input name="pagado" type="checkbox" value="0">
                </div>
        	</div>
        	<?php } else { ?>
        		<input name="pagado" type="hidden" value="0">
        	<?php } ?>
        </div>
        <br />
        <button type="submit" class="btn btn-success tiny pull-right"><i class="fas fa-save"></i> GUARDAR</button>
     </form>  
</fieldset>
<script type="text/javascript">
    $( document ).ready(function() {
        $("#valor").keydown(function(e) {
        	if (e.keyCode == 188 || e.charCode == 188) return false;
        });
    });
</script>