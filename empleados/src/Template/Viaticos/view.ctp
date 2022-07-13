<?php 
$usuario = $this->request->getSession()->read('Auth.User');
$disabled = ($usuario['tipo_usuario']==2)?" disabled ":"";
?>
<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?= __('Ver Viatico ') ?> <button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/viaticos/index'"><i class="fas fa-undo"></i> Atrás</button></h4>
</div>
<fieldset class="form">
         
    <div class="col-sm-12 center">
    	<div class="row">
        	<div class="col-sm-12"> 
    			<label class="col-sm-2">Fecha</label>
               	<input disabled class="col-sm-8" type="date" name="fecha" value="<?php echo date('Y-m-d',strtotime($viatico->fecha));?>" />
            </div>
    	</div>
    	<div class="row">
        	<div class="col-sm-12"> 
    			<label class="col-sm-2">Descripción</label>
               	<input disabled type="text" name="direccion" id="direccion" autocomplete="off" class="col-sm-8" value="<?php echo $viatico->descripcion;?>">
            </div>
        	
   		</div>
    	<div class="row">
        	<div class="col-sm-12"> 
    			<label class="col-sm-2">Valor $</label>
               	<input disabled class="col-sm-8" type="text" name="costo" placeholder="0,00" value="<?php echo number_format($viatico->valor,2,',','.');?>" />
            </div>
    	</div>
    	<?php if ($usuario['tipo_usuario']!=2) { ?>
    	<div class="row">
        	<div class="col-sm-12"> 
    			<label class="col-sm-2">Carga</label>
    			<input name="carga" type="radio" value="1" <?php if ($viatico->carga) echo " checked ";?> disabled> Automatico&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<input name="carga" type="radio" value="0" <?php if ($viatico->carga==0) echo " checked ";?> disabled>Manual
            </div>
    	</div>
    	<?php } ?>
    	<div class="row">
        	<div class="col-sm-12"> 
    			<label class="col-sm-2">Pagado</label>
    			<input name="pagado" type="checkbox" value="1" <?php if ($viatico->pagado) echo " checked ";?> disabled>
            </div>
    	</div>
    </div>
</fieldset>
<script type="text/javascript">
    $(function () {
    	$('#servicios-ids').multiselect('destroy');
    });
</script>
