<div style="background-color:aliceblue;" data-topbar role="navigation">
    <h4 align="center">Planilla para: <?= h($planilla->user->razonsocial) ?> 
    	<button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/planillas/index'"><i class="fas fa-undo"></i> Atrás</button>
    </h4>
</div>
<hr>
<div class="col-sm-6 center">
    <table class="vertical-table">

        <tr>
            <th scope="row"><?= __('Razon Social') ?></th>
            <td><?= h($planilla->user->razonsocial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($planilla->descripcion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Periodo') ?></th>
            <td><?= h($planilla->periodo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Link') ?></th>
            <td><?= h($planilla->link) ?></td>
        </tr>
        
       
        <tr>
            <th scope="row"><?= __('Cargado por') ?></th>
            <td><?= h($cargado['0']['apellido']) ?> <?= h($cargado['0']['nombre']) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Modificado por ') ?></th>
            <td><?php if (!empty($modificado)) {echo $modificado['0']['apellido'];echo " "; echo $modificado['0']['nombre'];} ?></td>
        </tr>
    </table>
</div>
