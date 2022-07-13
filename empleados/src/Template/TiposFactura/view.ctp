<div style="background-color:aliceblue;" data-topbar role="navigation">
        <h4 align="center">Tipo de Factura
        	<button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/TiposFactura/index'"><i class="fas fa-undo"></i> Atrás</button>
        </h4>
    </div>
 	<hr>
 	<div class="col-sm-6 center">
        <table class="vertical-table">
    
            <tr>
                <th scope="row"><?= __('Descripción') ?></th>
                <td><?= h($tipo->descripcion) ?></td>
            </tr>
            <tr>
            	<th scope="row">Habilitado</th>
            	<td><?= ($tipo->habilitado)?'Si':'No'; ?></td>
            </tr>
        </table>
	</div>