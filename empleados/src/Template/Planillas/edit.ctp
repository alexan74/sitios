<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?= __('Editar Planilla ') ?> <button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/planillas/index'"><i class="fas fa-undo"></i> Atrás</button></h4>
</div>
<fieldset class="form">
    <form method="post" accept-charset="utf-8" action="/planillas/edit/<?php echo $planilla['id'];?>">        
        <div class="col-sm-12 center">
            <div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Descripcion</label>
                   	<input class="col-sm-8" type="text" name="descripcion" value="<?php echo $planilla['descripcion'];?>" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Periodo</label>
                   	<input class="col-sm-8" type="text" name="periodo" value="<?php echo $planilla['periodo'];?>" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Link</label>
                   	<input class="col-sm-8" type="text" name="link" value="<?php echo $planilla['link'];?>" maxlength="500" />
                </div>
        	</div>
        	<input type="hidden" name="cliente_id" value="<?php echo $planilla['cliente_id'];?>" />	
        	<input type="hidden" name="modified_by" value="<?php echo $modificado;?>" >
       	</div>
        <br />
        <button type="submit" class="btn btn-success tiny pull-right"><i class="fas fa-save"></i> GUARDAR</button>
     </form>  
</fieldset>