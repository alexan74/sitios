<div style="background-color:aliceblue;"  data-topbar role="navigation">
    <h4 align="center">Clientes <button  class="btn btn-success pull-right tiny"  onclick="location.href='/clientes/add'" ><i class="fas fa-plus"></i> Cliente</button></h4>
</div>

<fieldset>
    <form method="post" action="/clientes/index/">
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
                <a href="/clientes/limpiar/" class="btn btn-secondary"><i class="fas fa-broom"></i> Limpiar</a>
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
                <th width="250px" scope="col">Razón Social<?php //echo $this->Paginator->sort('Razón Social') ?></th>
                <th width="70px" scope="col">Tel. Laboral</th>
                <th width="70px" scope="col">Tel. Personal</th>
               	<th width="150px" scope="col">Dirección</th>
                <th width="30px"scope="col" ><?= __('Ver') ?></th>
                <th width="30px"scope="col" ><?= __('Editar') ?></th>
                <!-- <th width="30px" scope="col" ><?= __('Eliminar') ?></th>-->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= h($cliente->razonsocial) ?></td>
                <td><?= h($cliente->telefono_trab) ?></td>
                <td><?= h($cliente->telefono_personal) ?></td>
             	<td><?= h($cliente->direccion) ?></td>      
                <td class="actions">
                    <button type="button" onclick="window.location.href='/clientes/view/<?= $cliente->id ?>'"  class="btn btn-info tiny"> <i class="fas fa-search"></i></button>
                </td>
                <td class="actions">   
                    <button type="button" onclick="window.location.href='/clientes/edit/<?= $cliente->id ?>'"  class="btn btn-success tiny"> <i class="fas fa-edit"></i></button>
                </td>  
                <!-- <td class="actions">
                    <a class="btn btn-danger tiny" href="/clientes/delete/<?= $cliente['id']; ?>" onclick="return confirm('Estás seguro que deseas eliminar el Usuario <?= $cliente['apellido']; ?> ');"><i class="fas fa-trash-alt"></i></a>
                </td>-->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br />
</div>