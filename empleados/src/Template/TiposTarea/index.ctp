<div style="background-color:aliceblue;"  data-topbar role="navigation">
    <h4 align="center">Tipos de Tarea
    <button  class="btn btn-success pull-right tiny"  onclick="location.href='/TiposTarea/add'" ><i class="fas fa-plus"></i> Tipo de Tarea</button>
    </h4>
</div>
<fieldset>
    <form method="post" action="/TiposTarea/index/">
        <h4><?= __('Busqueda') ?></h4>
        <div class="row">
            <div class="col-sm-4 espacioV"> 
            	<label>Descripción</label>
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
                <a href="/TiposTarea/limpiar/" class="btn btn-secondary"><i class="fas fa-broom"></i> Limpiar</a>
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
                <th width="30px"scope="col" ><?= __('Editar') ?></th>
                <th width="30px" scope="col" ><?= __('Eliminar') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tipos as $tipo): ?>
            <tr>      
                <td><?= h($tipo->descripcion) ?></td>
                <td class="actions">
                    <button type="button" onclick="window.location.href='/TiposTarea/view/<?= $tipo->id ?>'"  class="btn btn-info tiny"> <i class="fas fa-search"></i></button>
                </td>
                <td class="actions">
                    <button type="button" onclick="window.location.href='/TiposTarea/edit/<?= $tipo->id ?>'"  class="btn btn-success tiny"> <i class="fas fa-edit"></i></button>
                </td>  
                <td class="actions">                    
                    <a class="btn btn-danger tiny" href="/TiposTarea/delete/<?= $tipo['id']; ?>" onclick="return confirm('Estás seguro que deseas eliminar el tipo <?= $tipo['descripcion']; ?> ');"><i class="fas fa-trash-alt"></i></a>
                
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>