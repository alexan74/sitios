<div style="background-color:aliceblue;" data-topbar role="navigation">
    <h4 align="center">Ficha cliente: <?= h($cliente->razonsocial) ?> 
    	<button type="button" class="btn btn-danger tiny pull-right"  onclick="location.href='/clientes/index'"><i class="fas fa-undo"></i> Atrás</button>
    </h4>
</div>
<hr>
<div class="col-sm-6 center">
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= h($cliente->username) ?></td>
        </tr>
         <tr>
            <th scope="row"><?= __('Tipo de Cliente') ?></th>
            <td>
            	<select name="role" class="col-sm-8" disabled>
                    <option value="consorcio" <?php if($cliente['role']== "consorcio"){echo "selected";}; ?>>Consorcio</option>
                    <option value="comercio" <?php if($cliente['role']== "comercio"){echo "selected";}; ?>>Comercio</option>
                    <option value="particular" <?php if($cliente['role']== "particular"){echo "selected";}; ?>>Particular</option>
                    <option value="administrador" <?php if($cliente['role']== "administrador"){echo "selected";}; ?>>Administrador</option>       
        		</select>
        	</td>
        </tr>  
        <tr>
            <th scope="row"><?= __('Razonsocial') ?></th>
            <td><?= h($cliente->razonsocial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cuil/Cuit') ?></th>
            <td><?= $this->Number->format($cliente->cuilt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellido') ?></th>
            <td><?= h($cliente->apellido) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($cliente->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tel. Laboral') ?></th>
            <td><?= h($cliente->telefono_trab) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tel. Personal') ?></th>
            <td><?= h($cliente->telefono_personal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Direccion') ?></th>
            <td><?= h($cliente->direccion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($cliente->email) ?></td>
        </tr>
    </table>
</div>
