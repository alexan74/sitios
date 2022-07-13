<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?= __('Nuevo Usuario ') ?> <button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/clientes/index'"><i class="fas fa-undo"></i> Atrás</button></h4>
</div>
<fieldset class="form">
    <form method="post" accept-charset="utf-8" action="/clientes/add">        
        <div class="col-sm-12 center">
            <div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Usuario</label>
                   	<input class="col-sm-8" type="text" name="username" required/>
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
        			<label class="col-sm-2">Tipo de Cliente:</label>
                   	 <select name="role" class="col-sm-8" required >
						<option value="">Seleccione tipo</option>
                        <option value="consorcio">Consorcio</option>
                        <option value="comercio">Comercio</option>
                        <option value="particular">Particular</option>
                        <?php if($this->request->session()->read('Auth.User.role') =="administrador"){?>
                        <option value="administrador">Administrador</option>
                        <?php } ?>
            		</select>
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Cuit / Cuil</label>
                   	<input class="col-sm-8" type="text" name="cuilt" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Razón Social</label>
                   	<input class="col-sm-8" type="text" name="razonsocial" />
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
        			<label class="col-sm-2">Tel. Laboral</label>
                   	<input class="col-sm-8" type="text" name="telefono_trab" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Tel. Personal</label>
                   	<input class="col-sm-8" type="text" name="telefono_personal" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Dirección</label>
                   	<input class="col-sm-8" type="text" name="direccion" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Email</label>
                   	<input class="col-sm-8" type="text" name="email" />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Habilitado:</label>
                   	 <select name="habilitado" class="col-sm-8">
                        <option value="0">Si</option>
                        <option value="1">No</option>
            		</select>
                </div>
        	</div>
        </div>
        <br />
        <button type="submit" class="btn btn-success tiny pull-right"><i class="fas fa-save"></i> GUARDAR</button>
     </form>  
</fieldset>