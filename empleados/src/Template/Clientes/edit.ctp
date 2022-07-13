<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?= __('Editar Cliente ') ?> <button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/clientes/index'"><i class="fas fa-undo"></i> Atrás</button></h4>
</div>
<fieldset class="form">
    <form method="post" accept-charset="utf-8" action="/clientes/edit/<?php echo $cliente['id'];?>">        
        <div class="col-sm-12 center">
            <div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Usuario</label>
                   	<input class="col-sm-8" type="text" name="username" value="<?php echo $cliente['username'];?>" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Contraseña</label>
                   	<input class="col-sm-8" type="password" name="password" value="<?php echo $cliente['password'];?>" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Tipo de Cliente:</label>
                   	 <select name="role" class="col-sm-8" required >
						<option value="">Seleccione tipo</option>
                        <option value="consorcio" <?php if($cliente['role']== "consorcio"){echo "selected";}; ?>>Consorcio</option>
                        <option value="comercio" <?php if($cliente['role']== "comercio"){echo "selected";}; ?>>Comercio</option>
                        <option value="particular" <?php if($cliente['role']== "particular"){echo "selected";}; ?>>Particular</option>
                        <option value="administrador" <?php if($cliente['role']== "administrador"){echo "selected";}; ?>>Administrador</option>
            		</select>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Cuit / Cuil</label>
                   	<input class="col-sm-8" type="text" name="cuilt" value="<?php echo $cliente['cuilt'];?>" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Razón Social</label>
                   	<input class="col-sm-8" type="text" name="razonsocial" value="<?php echo $cliente['razonsocial'];?>" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Apellido</label>
                   	<input class="col-sm-8" type="text" name="apellido" value="<?php echo $cliente['apellido'];?>" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Nombre</label>
                   	<input class="col-sm-8" type="text" name="nombre" value="<?php echo $cliente['nombre'];?>" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Tel. Laboral</label>
                   	<input class="col-sm-8" type="text" name="telefono_trab" value="<?php echo $cliente['telefono_trab'];?>" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Tel. Personal</label>
                   	<input class="col-sm-8" type="text" name="telefono_personal" value="<?php echo $cliente['telefono_personal'];?>" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Dirección</label>
                   	<input class="col-sm-8" type="text" name="direccion" value="<?php echo $cliente['direccion'];?>" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Email</label>
                   	<input class="col-sm-8" type="text" name="email" value="<?php echo $cliente['email'];?>" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Habilitado:</label>
                   	 <select name="habilitado" class="col-sm-8">
                        <option value="0" <?php if($cliente['habilitado']==0){echo "selected";}; ?>>Si</option>
                        <option value="1" <?php if($cliente['habilitado']==1){echo "selected";}; ?>>No</option>
            		</select>
                </div>
        	</div>
        </div>
        <br />
        <button type="submit" class="btn btn-success tiny pull-right"><i class="fas fa-save"></i> GUARDAR</button>
     </form>  
</fieldset>