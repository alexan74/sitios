<?php $usuario = $this->request->getSession()->read('Auth.User'); ?>
<div style="background-color:aliceblue;"  data-topbar role="navigation">
    <h4 align="center">Servicios 
    <?php if($usuario['tipo_usuario']==1) {?> 
    <button  class="btn btn-success pull-right tiny" onclick="location.href='/servicios/add/'"><i class="fas fa-plus"></i> Servicio</button>
    <?php } ?>
    </h4>
</div>
<fieldset>
    <form method="post" action="/servicios/index/">
        <h4><?= __('Busqueda') ?></h4>
        <div class="row">
        	<div class="col-sm-4 espacioV"> 
            	<label>Descripcion</label>
               	<input type="text" name="descripcion"  value="<?php echo $descripcion;?>">
            </div>
            <div class="col-sm-2 espacioV"> 
            	<label>Habilitado</label>
            	<select name="habilitado">
                    <option value="-1" <?php echo ($habilitado==-1)?" selected ":"";?>></option>
                    <option value="1" <?php echo ($habilitado==1)?" selected ":"";?>>Si</option>	
                    <option value="0" <?php echo ($habilitado==0)?" selected ":"";?>>No</option>     
            	</select>
            </div>
            <div class="col-sm-2 espacioV">          
                <button type="submit" class="btn btn-primary" ><i class="fas fa-search"></i> Buscar</button>
            </div>
            <div class="col-sm-2 espacioV">
                <a href="/servicios/limpiar/" class="btn btn-secondary"><i class="fas fa-broom"></i> Limpiar</a>
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
            	<th width="230px" scope="col">Descripción</th>
                <th width="50px"scope="col" ><?= __('Ver') ?></th>
                <?php if($usuario['tipo_usuario']==1) {?> 
                <th width="30px"scope="col" ><?= __('Editar') ?></th>
                <th width="30px" scope="col" ><?= __('Eliminar') ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($servicios as $servicio): ?>
            <tr>               
            	<td><?= h($servicio->descripcion) ?></td>
            	<td class="actions">
                    <button type="button" onclick="window.location.href='/servicios/view/<?= $servicio->id ?>'"  class="btn btn-info tiny"> <i class="fas fa-search"></i></button>
                </td>
                <?php if($usuario['tipo_usuario']==1) {?> 
                <td class="actions">
                    <button type="button" onclick="window.location.href='/servicios/edit/<?= $servicio->id ?>'"  class="btn btn-success tiny"> <i class="fas fa-edit"></i></button>
                </td>  
                <td class="actions">
                    <form method="post" action="/servicios/delete/<?= $servicio['id']; ?>">
                    <button class="btn btn-danger tiny"  onclick="return confirm('Estás seguro que deseas eliminar el servicio <?= $servicio['descripcion']; ?> ');"  type="submit" value="Eliminar"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td><?php } ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br />
</div>