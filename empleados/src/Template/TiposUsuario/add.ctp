<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?= __('Nuevo Tipo de usuario ') ?> <button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/TiposUsuario/index'"><i class="fas fa-undo"></i> Atrás</button></h4>
</div>
<fieldset class="form">
    <form method="post" accept-charset="utf-8" action="/TiposUsuario/add">
		<div class="col-sm-12 center">
            <div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Descripción</label>
                   	<input class="col-sm-8" type="text" name="descripcion" />
                </div>
        	</div>
			<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Habilitado:</label>
                   	<select name="habilitado" class="col-sm-8">
                        <option value="1" selected>Si</option>
                        <option value="0">No</option>
            		</select>
                </div>
        	</div>
		</div>
        <br />
        <button type="submit" class="btn btn-success tiny pull-right"><i class="fas fa-save"></i> GUARDAR</button>
     </form>  
</fieldset>