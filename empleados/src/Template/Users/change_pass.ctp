<div style="background-color:aliceblue;"  data-topbar role="navigation">
	<h4 align="center"><?php echo __('Cambiar contraseña '); ?> 
		<button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/users/view/<?php echo $user->id;?>'">
			<i class="fas fa-undo"></i> Atrás
		</button>
	</h4>
</div>
<fieldset class="form">
    <form method="post" accept-charset="utf-8" action="/users/change_pass/<?php echo $user->id;?>">        
        <div class="col-sm-12 center">
            <div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Contraseña</label>
                   	<input class="col-sm-8" type="password" name="password" required />
                </div>
        	</div>
        	<div class="row">
            	<div class="col-sm-12 espacioV"> 
        			<label class="col-sm-2">Repetir Contraseña</label>
                   	<input class="col-sm-8" type="password" name="twopassword" required />
                </div>
        	</div>
        </div>
        <br />
        <button type="submit" class="btn btn-success tiny pull-right"><i class="fas fa-save"></i> GUARDAR</button>
     </form>  
</fieldset>