<?php $usuario = $this->request->getSession()->read('Auth.User'); ?>
<div style="background-color:aliceblue;" data-topbar role="navigation">
    <h4 align="center"><?php echo ($this->request->session()->read('escliente'))?__('Cliente '):__('Empleado '); ?>  <?php //echo h($user->username) ?>
    	<?php if($usuario['tipo_usuario']==1){?> 
    	<button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/users/index/<?php echo ($this->request->session()->read('escliente'))?"1":"";?>'"><i class="fas fa-undo"></i> Atrás</button>
    	<?php } ?>
    </h4>
</div>
<hr>
<div class="col-sm-6 center">
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
         <tr>
            <th scope="row"><?= __('Tipo de usuario') ?></th>
            <td><select name="tipo_usuario" class="col-sm-8" disabled>
            	<?php foreach ($tipos as $tipo) { ?>
                <option value="<?php echo $tipo['id'];?>" <?php if($user['tipo_usuario']==$tipo['id']){echo " selected ";}; ?>>
                	<?php echo $tipo['descripcion'];?>
                </option>
                <?php } ?>
    		</select></td>
        </tr>      
        <tr>
            <th scope="row"><?= __('Apellido') ?></th>
            <td><?= h($user->apellido) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($user->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Teléfono') ?></th>
            <td><?= h($user->telefono) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Habilitado') ?></th>
            <td><?=($user->habilitado==1)?"Si":"No"; ?></td>
        </tr>
    </table>
    <?php if ($usuario['tipo_usuario']==2){ ?>
        <div style="text-align:center;">
        	<button type="button" class="btn btn-success tiny" onclick="location.href='/users/change_pass/<?php echo $user->id;?>'"><i class="fas fa-key"></i> CAMBIAR CONTRASEÑA</button>
        </div>
    <?php } ?>
</div>
