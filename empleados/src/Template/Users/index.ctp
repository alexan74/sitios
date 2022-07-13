<div style="background-color:aliceblue;"  data-topbar role="navigation">
    <h4 align="center">Empleados <button  class="btn btn-success pull-right tiny"  onclick="location.href='/users/add'" ><i class="fas fa-plus"></i> empleado</button></h4>
</div>

<fieldset>
    <form method="post" action="/users/index/">
        <h4><?= __('Busqueda') ?></h4>
        <div class="row">
            <div class="col-sm-2 espacioV">
            	<label>Apellido</label>
               	<input type="text" name="apellido"  value="<?php echo $apellido;?>">
            </div>
            <div class="col-sm-2 espacioV">
            	<label>Nombre</label>
               	<input type="text" name="nombre"  value="<?php echo $nombre;?>">
            </div>
            <div class="col-sm-2 espacioV"> 
            	<label>Habilitado</label><br />
            	<select name="habilitado">
                    <option value="-1" <?php echo ($habilitado==-1)?" selected ":"";?>></option>
                    <option value="1" <?php echo ($habilitado==1)?" selected ":"";?>>Si</option>	
                    <option value="0" <?php echo ($habilitado==0)?" selected ":"";?>>No</option>     
            	</select>
            </div>
            <div class="col-sm-2 espacioV" style="padding-top:22px;">          
                <button type="submit" class="btn btn-primary" ><i class="fas fa-search"></i> Buscar</button>
            </div>
            <div class="col-sm-2 espacioV" style="padding-top:22px;">
                <a href="/users/limpiar/" class="btn btn-secondary"><i class="fas fa-broom"></i> Limpiar</a>
            </div>
        </div>
       
    </form> 
</fieldset>
<hr style="border-color:blue;">
<h4><?= __('Consulta') ?></h4>
<div class="table-responsive">
	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            	<!-- <th width="250px" scope="col"><? //echo $this->Paginator->sort('usuario','Empleado'); ?></th>-->
                <th width="120px" scope="col">Usuario<?php //echo $this->Paginator->sort('usuario','Usuario'); ?></th>
                <th scope="col">Apellido</th>
                <th scope="col">Nombre</th>
                <th width="100px" scope="col">Teléfono</th>
                <th width="200px" scope="col">Email</th>
                <th width="100px" scope="col">Habilitado</th>
                <th width="30px"scope="col" ><?= __('Ver'); ?></th>
                <th width="30px"scope="col" ><?= __('Editar'); ?></th>
                <th width="30px" scope="col" ><?= __('Eliminar'); ?></th>
                
            </tr>
        </thead>
        <tbody> 
        	<?php if (!empty($users)) {?>
                <?php foreach ($users as $user): ?>
                <tr>
                    <!-- <td><? //echo $this->Number->format($user->id); ?></td>--> 
                    <td><?= h($user->username); ?></td>
                    <td><?= h($user->apellido); ?></td>
                    <td><?= h($user->nombre); ?></td>
                    <td><?= h($user->telefono); ?></td>
                 	<td><?= h($user->email); ?></td>
                    <td><?= ($user->habilitado)?'Si':'No';?></td>
                    <td class="actions">
                        <button type="button" onclick="window.location.href='/users/view/<?= $user->id ?>'"  class="btn btn-info tiny"> <i class="fas fa-search"></i></button>
                    </td>
                    <td class="actions">   
                        <button type="button" onclick="window.location.href='/users/edit/<?= $user->id ?>'"  class="btn btn-success tiny"> <i class="fas fa-edit"></i></button>
                    </td>  
                    <td class="actions">
                        <a class="btn btn-danger tiny" href="/users/delete/<?= $user['id']; ?>" onclick="return confirm('Estás seguro que deseas eliminar el Usuario <?= $user['apellido']; ?> ');"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php } else { ?>
            	<tr><td colspan="9"><h3>No hay resultado que mostrar...</h3></td></tr>
            <?php } ?>
        </tbody>
    </table>
    <br />
</div>