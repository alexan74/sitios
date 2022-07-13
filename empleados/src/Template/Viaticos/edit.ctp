<?php
$usuario = $this->request->getSession()->read('Auth.User');
$disabled = ($usuario['tipo_usuario']==2)?" disabled ":"";
?>
<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?= __('Editar Viatico ') ?> <button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/viaticos/index'"><i class="fas fa-undo"></i> Atrás</button></h4>
</div>
<fieldset class="form">
    <form method="post" accept-charset="utf-8" action="/viaticos/edit/<?php echo $viatico->id;?>">
    	<input type="hidden" name="empleado_id" value="<?php echo $viatico->empleado_id;?>" />
        <input type="hidden" name="tarea_id" value="<?php echo $viatico->tarea_id;?>" />        
        <div class="col-sm-12 center">
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Fecha</label>
        			
                   	<input required="required" class="col-sm-8" type="date" name="fecha<?php echo $disabled; ?>" value="<?php echo date('Y-m-d',strtotime($viatico->fecha));?>" <?php echo $disabled; ?> />
                   	<?php if (!empty($disabled)) { ?>
                   	<input type="hidden" name="fecha" value="<?php echo date('Y-m-d',strtotime($viatico->fecha));?>" />
                   	<?php } ?>
                </div>
			</div>
			<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Descripción</label>
                   	<input type="text" name="descripcion" id="descripcion" autocomplete="off" class="col-sm-8" value="<?php echo $viatico->descripcion;?>" <?= ($viatico->tarea_id)?" disabled ":"";?> />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Valor $</label>
                   	<input required="required" class="col-sm-8" type="number" name="valor" id="valor" step=".01" placeholder="0.00" value="<?php echo $viatico->valor;?>" <?= ($viatico->tarea_id)?" disabled ":"";?> />
                </div>
        	</div>
        	<?php if ($usuario['tipo_usuario']!=2) { ?>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Carga</label>
        			<input name="carga" type="radio" value="1" <?php if ($viatico->carga) echo " checked ";?> <?php echo $disabled; ?>> Automatico&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<input name="carga" type="radio" value="0" <?php if ($viatico->carga==0) echo " checked ";?> <?php echo $disabled; ?>>Manual
                </div>
        	</div>
        	<?php } else { ?>
        	    <input name="carga" type="hidden" value="<?= (!empty($viatico->carga))?1:0;?>">
        	<?php }?>
        	<div class="row">
            	<div class="col-sm-12"> 
        			<label class="col-sm-2">Pagado</label>
        			<input name="pagado" type="checkbox" value="1" <?php if ($viatico->pagado) echo " checked ";?>>
                </div>
        	</div>
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