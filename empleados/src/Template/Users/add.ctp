<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?php echo __('Nuevo empleado '); ?> 
		<button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/users/index/'">
			<i class="fas fa-undo"></i> Atrás
		</button>
	</h4>
</div>
<fieldset class="form">
    <form method="post" accept-charset="utf-8" action="/users/add">        
        <div class="col-sm-12 center">
            <div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Usuario</label>
                   	<input class="col-sm-8" type="text" name="username" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Contraseña</label>
                   	<input class="col-sm-8" type="password" name="password" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Tipo de usuario:</label>
                   	<select name="tipo_usuario" class="col-sm-8" >
                    	<?php foreach ($tipos as $tipo) { ?>
                        <option value="<?php echo $tipo['id'];?>" <?php if($user['tipo_usuario']!=1){echo " selected ";}; ?>>
                        	<?php echo ucfirst($tipo['descripcion']);?>
                        </option>
                        <?php } ?>
            		</select>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Apellido</label>
                   	<input class="col-sm-8" type="text" name="apellido" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Nombre</label>
                   	<input class="col-sm-8" type="text" name="nombre" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Teléfono</label>
                   	<input class="col-sm-8" type="text" name="telefono" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Email</label>
                   	<input class="col-sm-8" type="email" name="email" required />
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