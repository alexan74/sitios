<?php $usuario = $this->request->getSession()->read('Auth.User'); ?>
<div style="background-color:aliceblue;"  data-topbar role="navigation">
    <h4 align="center">Planillas 
    <?php if($usuario['tipo_usuario']==1) {?>  
    <button  class="btn btn-success pull-right tiny"  onclick="location.href='/planillas/add/<?php echo $cliente_id;?>'" ><i class="fas fa-plus"></i> Planilla</button>
    <?php } ?>
    </h4>
</div>
<fieldset>
    <form method="post" action="/planillas/index/">
        <h4><?= __('Busqueda') ?></h4>
        <div class="row">
        	<div class="col-sm-4 espacioV"> 
            	<label>Razón Social</label>
               	<input type="text" name="razonsocial"  value="<?php echo $razonsocial;?>">
            </div>
            <div class="col-sm-4 espacioV">
            	<label>Dirección</label>
               	<input type="text" name="direccion"  value="<?php echo $direccion;?>">
            </div>
            <div class="col-sm-2 espacioV">          
                <button type="submit" class="btn btn-primary" ><i class="fas fa-search"></i> Buscar</button>
            </div>
            <div class="col-sm-2 espacioV">
                <a href="/planillas/limpiar/" class="btn btn-secondary"><i class="fas fa-broom"></i> Limpiar</a>
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
            	<th width="230px" scope="col"> Social</th>
                <th width="150px"  scope="col">Dirección</th>
                <th width="100px"scope="col">Descripción</th>
                <th width="80px"scope="col">Pperiodo</th>
                <th width="50px"scope="col" ><?= __('Ver') ?></th>
                <?php if($usuario['tipo_usuario']==1) {?> 
                <th width="30px"scope="col" ><?= __('Detalle') ?></th>
                <th width="30px"scope="col" ><?= __('Editar') ?></th>
                <th width="30px" scope="col" ><?= __('Eliminar') ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($planillas as $planilla): ?>
            <tr>               
            	<td><?= h($planilla->user->razonsocial) ?></td>
                <td><?= h($planilla->user->direccion) ?></td>
                <td><?= h($planilla->descripcion) ?></td>
                <td><?= h($planilla->periodo) ?></td>
                <td class="actions">
                    <a target="_blank" href="<?= h($planilla->link) ?>"  class="btn btn-primary tiny"> Ver</a>
                </td>
                <?php if($this->request->session()->read('Auth.User.role')=="administrador"){?>
                <td class="actions">
                    <button type="button" onclick="window.location.href='/planillas/view/<?= $planilla->id ?>'"  class="btn btn-info tiny"> <i class="fas fa-search"></i></button>
                </td>  
                <td class="actions">
                    <button type="button" onclick="window.location.href='/planillas/edit/<?= $planilla->id ?>'"  class="btn btn-success tiny"> <i class="fas fa-edit"></i></button>
                </td>  
                <td class="actions">
                    <form method="post" action="/planillas/delete/<?= $planilla['id']; ?>">
                    <button class="btn btn-danger tiny"  onclick="return confirm('Estás seguro que deseas eliminar la planilla <?= $planilla['descripcion']; ?> ');"  type="submit" value="Eliminar"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td><?php } ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br />
</div>