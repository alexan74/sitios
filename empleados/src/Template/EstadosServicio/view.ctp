<div style="background-color:aliceblue;" data-topbar role="navigation">
        <h4 align="center">Estado de servicio
        	<button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/EstadosServicio/index'"><i class="fas fa-undo"></i> Atrás</button>
        </h4>
    </div>
 	<hr>
 	<div class="col-sm-6 center">
        <table class="vertical-table">
    
            <tr>
                <th scope="row"><?= __('Descripción') ?></th>
                <td><?= h($estado->descripcion) ?></td>
            </tr>
            <tr>
            	<th scope="row">Habilitado</th>
            	<td><?= ($estado->habilitado)?'Si':'No'; ?></td>
            </tr>
        </table>
	</div>