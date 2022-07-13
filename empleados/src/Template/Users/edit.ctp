<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?php echo ($this->request->session()->read('escliente'))?__('Editar cleinte '):__('Editar empleado '); ?> 
    	<button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/users/index/<?php echo ($this->request->session()->read('escliente'))?"1":"";?>'">
    		<i class="fas fa-undo"></i> Atrás
    	</button>
   	</h4>
</div>
<fieldset class="form">
    <form method="post" accept-charset="utf-8" action="/users/edit/<?php echo $user['id'];?>">        
        <div class="col-sm-12 center">
            <div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Usuario</label>
                   	<input class="col-sm-8" type="text" name="username" value="<?php echo $user['username'];?>" required />
                </div>
        	</div>
        	<?php if ($this->request->getSession()->read('Auth.User.tipo_usuario')==1) { ?>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Contraseña</label>
                   	<input class="col-sm-8" type="password" name="password" value="<?php echo $user['password'];?>" required />
                </div>
        	</div>
        	<?php } ?>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Tipo de Usuario:</label>
        			<?php  if ($this->request->session()->read('escliente')) { ?>
                		<input type="text" type="text" name="tipo_usuario" value="3" disabled />
                	<?php } else { ?>
                       	<select name="tipo_usuario" class="col-sm-8" >
                        	<?php foreach ($tipos as $tipo) { ?>
                            <option value="<?php echo $tipo['id'];?>" <?php if($user['tipo_usuario']==$tipo['id']){echo " selected ";}; ?>>
                            	<?php echo $tipo['descripcion'];?>
                            </option>
                            <?php } ?>
                		</select>
                	<?php } ?>
                </div>
        	</div>
        	
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Apellido</label>
                   	<input class="col-sm-8" type="text" name="apellido" value="<?php echo $user['apellido'];?>" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Nombre</label>
                   	<input class="col-sm-8" type="text" name="nombre" value="<?php echo $user['nombre'];?>" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Teléfono</label>
                   	<input class="col-sm-8" type="text" name="telefono" value="<?php echo $user['telefono'];?>" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Email</label>
                   	<input class="col-sm-8" type="text" name="email" value="<?php echo $user['email'];?>" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Habilitado:</label>
                   	 <select name="habilitado" class="col-sm-8">
                        <option value="1" <?php if($user['habilitado']==1){echo "selected";}; ?>>Si</option>
                        <option value="0" <?php if($user['habilitado']==0){echo "selected";}; ?>>No</option>
            		</select>
                </div>
        	</div>
        </div>
        <br />
        <button type="submit" class="btn btn-success tiny pull-right"><i class="fas fa-save"></i> GUARDAR</button>
     </form>  
</fieldset>