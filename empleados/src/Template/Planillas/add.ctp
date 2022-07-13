<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?= __('Nueva Planilla ') ?> <button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/planillas/index'"><i class="fas fa-undo"></i> Atrás</button></h4>
</div>
<fieldset class="form">
    <form method="post" accept-charset="utf-8" action="/planillas/add/">        
        <div class="col-sm-12 center">
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Cliente</label>
        			<?php if($this->request->session()->read('Auth.User.role')=="administrador") {?>
                   		<select name="cliente_id" class="col-sm-8">
                   		<option value=""></option>
                   		<?php foreach ($clientes as $cliente) { ?>
                            <option value="<?php echo $cliente['id'];?>" 
                            <?php if (!empty($planilla) && $planilla['cliente_id']==$cliente['id']) echo " selected ";?>>
                            <?php echo $cliente['razonsocial'];?>
                        </option>
            			<?php } ?>
                		</select>
                   	<?php } else { ?>
                   		<input class="col-sm-8" type="hidden" name="cliente_id" value="<?php echo $this->request->session()->read('Auth.User.id');?>" />
                   	<?php } ?>
                </div>
        	</div>
            <div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Descripcion</label>
                   	<input class="col-sm-8" type="text" name="descripcion" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Periodo</label>
                   	<input class="col-sm-8" type="text" name="periodo" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Link</label>
                   	<input class="col-sm-8" type="text" name="link" maxlength="500"/>
                </div>
        	</div>
        </div>
        <br />
        <button type="submit" class="btn btn-success tiny pull-right"><i class="fas fa-save"></i> GUARDAR</button>
     </form>  
</fieldset>