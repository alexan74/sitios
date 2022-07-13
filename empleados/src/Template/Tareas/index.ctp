<?php 
$usuario = $this->request->getSession()->read('Auth.User');
//debug($tareas->toArray()); 
?>
<div style="background-color:aliceblue;"  data-topbar role="navigation">
    <h4 align="center">Tareas 
    <button  class="btn btn-success pull-right tiny"  onclick="location.href='/tareas/add/'" ><i class="fas fa-plus"></i> Tarea</button>
    </h4>
</div>
<fieldset>
    <form method="post" action="/tareas/index/">
        <h4><?= __('Busqueda') ?></h4>
        <div class="row">
        	<div class="col-sm-4"> 
            	<label class="col-sm-2 float">Fecha</label>
               	<div class="col-sm-5 float">
               		<label style="display:inline-flex">Desde:&nbsp;
               			<input type="date" name="desde" value="<?php echo $desde;?>">
               		</label>
               	</div>
               	<div class="col-sm-5 float">
               		<label style="display:inline-flex">Hasta:&nbsp;
               			<input type="date" name="hasta" value="<?php echo (empty($hasta))?date('Y-m-d'):$hasta;?>">
               		</label>
               	</div>
            </div>
            <?php if ($usuario['tipo_usuario']!=2) { ?>
            <div class="col-sm-4">
            	<label class="col-sm-3 float">Tipo de Pago</label>
            	<div class="col-sm-9 float">
                	<select name="tipo_pago_id">
                		<option value="">Seleccione tipo</option>
                		<?php foreach($tiposPago as $tipo) { ?>
                			<option value="<?php echo $tipo['id'];?>" <?php if ($tipo_pago_id==$tipo['id']) echo " selected ";?>><?php echo $tipo['descripcion'];?></option>
                		<?php } ?>
                	</select>
                </div>
            </div>
            <div class="col-sm-4">
            	<label class="col-sm-2 float">Pagado</label>
            	<div class="col-sm-9 float">
                	<select name="pagado">
                		<option value="" <?php if($pagado==-1) echo " selected ";?>>Todos</option>
                		<option value="1"<?php if($pagado==1) echo " selected ";?>>Si</option>
                		<option value="0"<?php if($pagado==0) echo " selected ";?>>No</option>
                	</select>
                </div>
            </div>
            <?php } ?>
       </div>
       <div class="row">
            <div class="col-sm-6">
                <label class="col-sm-2 float">Cliente</label>
                <div class="col-sm-9 float">
                   	<input type="text" name="cliente" id="cliente" autocomplete="off" value="<?php echo $cliente;?>" class="form-control">
                   	<input type="hidden" name="cliente_id" id="cliente_id" value="<?php echo $cliente_id;?>">
                </div>
            </div>
            <?php if ($usuario['tipo_usuario']!=2) { ?>
            <div class="col-sm-6">
            	<label class="col-sm-2 float">Empleados</label>
                <div class="col-sm-9 float">
                   	<!-- <input type="text" name="empleado" id="empleado" autocomplete="off" value="<?php //echo $empleado;?>" class="form-control">
                   	<input type="hidden" name="empleado_id" id="empleado_id" autocomplete="off" value="<?php //echo $empleado_id;?>">-->
                   	<select name="empleado_id">
                		<option value="">Seleccione empleado</option>
                		<?php foreach($empleados as $empleado) { ?>
                			<option value="<?php echo $empleado['id'];?>" <?php if ($empleado['id']==$empleado_id) echo " selected ";?>>
                			<?php echo $empleado['nombre']." ".$empleado['apellido'];?>
                			</option>
                		<?php } ?>
                	</select>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="row">
        	<div class="col-sm-6">
            	<label class="col-sm-2 float">Dirección</label>
                <div class="col-sm-9 float">
                   	<input type="text" name="direccion" id="direccion" autocomplete="off" value="<?php echo $direccion;?>" class="form-control">
                </div>
            </div>
        </div>
        <br />
        <div class="row">    
            <div class="col-sm-12 offset-sm-4"> 
                <div class="col-sm-2 float">          
                    <button type="submit" class="btn btn-primary" ><i class="fas fa-search"></i> Buscar</button>
                </div>
                <div class="col-sm-2 float">
                    <a href="/tareas/limpiar/" class="btn btn-secondary"><i class="fas fa-broom"></i> Limpiar</a>
                </div>
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
            	<th width="120px" scope="col">Fecha<?php //echo $this->Paginator->sort('fecha','Fecha') ?></th>
                <th width="200px"  scope="col">Cliente</th>
                <th width="200px"  scope="col">Dirección</th>
                <?php if ($usuario['tipo_usuario']!=2) { ?>
                <th width="200px"scope="col">Empleado</th>
                <th width="80px"scope="col">Tipo Pago</th>
                <th width="80px"scope="col">Pagado</th>
                <th width="80px"scope="col">Costo</th>
                <?php } ?>
                <th width="60px"scope="col">Estado</th>
                <th width="30px"scope="col" ><?= __('Ver') ?></th>
                <th width="30px"scope="col" ><?= __('Acción') ?></th>
                <?php if ($usuario['tipo_usuario']!=2) { ?>
                <th width="30px" scope="col" ><?= __('Eliminar') ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            $totalEfectivo = 0;
            $totalTransf = 0;
            $totalCorriente = 0;
            $totalDeudor = 0;
            foreach ($tareas as $tarea): 
                $color="";
                switch ($tarea->estado_servicio_id) {
                    case 1:
                        $color = "background-color:#A7D595";
                        break;
                    case 2:
                        $color = "background-color:#DF6567";
                        break;
                    case 3:
                        $color = "background-color:#FFF1CE";
                        break;
                    case 4:
                        $color = "background-color:#F5B171";
                        break;
                }
            ?>
            <tr>               
            	<td><?= h(date('d/m/Y',strtotime($tarea->fecha))) ?></td>
                <td><?= h($tarea->cliente->razonsocial) ?></td>
                <td><?= h($tarea->cliente->direccion) ?></td>
                <?php if ($usuario['tipo_usuario']!=2) { ?>
                <td><?= h($tarea->user->nombre." ".$tarea->user->apellido) ?></td>
                <td><?= h($tarea->tipos_pago->descripcion) ?></td>
                <td><?= h(($tarea->pagado)?"Si":"No") ?></td>
                <td><?= h(number_format($tarea->costo,2,',','.')) ?></td>
                <?php } ?>
                <td style="<?php echo $color;?>"><?= h($tarea->estados_servicio->descripcion) ?></td>
                <td class="actions">
                    <button type="button" onclick="window.location.href='/tareas/view/<?= $tarea->id ?>'"  class="btn btn-info tiny"> <i class="fas fa-search"></i></button>
                </td>  
                <td class="actions">
                    <button type="button" onclick="window.location.href='/tareas/edit/<?= $tarea->id ?>'"  class="btn btn-success tiny"> <i class="fas fa-edit"></i></button>
                </td> 
                <?php if ($usuario['tipo_usuario']!=2) { ?> 
                <td class="actions">
                    <form method="post" action="/tareas/delete/<?= $tarea['id']; ?>">
                    <button class="btn btn-danger tiny"  onclick="return confirm('Estás seguro que deseas eliminar la tarea #<?= $tarea['id']; ?> ');"  type="submit" value="Eliminar"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
                <?php } ?>
            </tr>
            <?php
            if ($tarea->pagado) {
                if ($tarea->tipo_pago_id == 1) {
                    $totalEfectivo += $tarea->costo;
                } elseif ($tarea->tipo_pago_id == 2) {
                    $totalTransf += $tarea->costo;
                }elseif ($tarea->tipo_pago_id == 3) {
                    $totalCorriente += $tarea->costo;
                }
            } else {
                /*if ($tarea->tipo_pago_id == 1) {
                    $totalNoEfectivo += $tarea->costo;
                } else {
                    $totalNoTransf += $tarea->costo;
                }*/
                //if ($tarea->tipo_pago_id == 4) {
                    $totalDeudor += $tarea->costo;
                //}
            }
            
            endforeach; ?>
        </tbody>
        <?php if ($usuario['tipo_usuario']!=2) { ?>
        <tfoot>
        	<tr>
        		<td colspan="<?= ($usuario['tipo_usuario']!=2)?4:2;?>"> Pagado Efectivo <span style="color:red">$ <?php echo number_format($totalEfectivo,2,',','.');?></span></td>
        		<td colspan="<?= ($usuario['tipo_usuario']!=2)?7:4;?>"> Pagado Transferencia <span style="color:red">$ <?php echo number_format($totalTransf,2,',','.');?></span></td>
        	</tr>
        	<tr>
            	<td colspan="<?= ($usuario['tipo_usuario']!=2)?4:2;?>"> Pagado C/Corriente <span style="color:red">$ <?php echo number_format($totalCorriente,2,',','.');?></span></td>
            	<td colspan="<?= ($usuario['tipo_usuario']!=2)?7:4;?>"> Deudor <span style="color:red">$ <?php echo number_format($totalDeudor,2,',','.');?></span></td>
        	</tr>
        </tfoot>
        <?php } ?>
    </table>
    <br />
</div>

<script type="text/javascript">
    $(function () {
		$("#cliente").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "/tareas/getClientes/",
                    type: 'POST',
                    dataType: 'json',
                    data: {valor: request.term},
                    success: function (data) {
                    	$('#cliente').val();                       
                        console.log(data);
                        response($.map(data, function(item) {
                            return {
                                label: item.label,                                
                                value: item.label,
                                id: item.value
                            };
                        }));
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    }   
                });
            },
            minLength: 2,
            select: function(event, ui) {   
            	console.log(ui);      	                	
                //$('#cliente').val(ui.item.label);
                $('#cliente_id').val(ui.item.id);
            }
        });
        $("#empleado").autocomplete({
            source: function (request, response) {
                 
                $.ajax({
                    url: "/tareas/getEmpleados/",
                    type: 'POST',
                    dataType: 'json',
                    data: {valor: request.term},
                    success: function (data) {                       
                        console.log(data);
                        response($.map(data, function(item) {
                            return {
                                label: item.label,                                
                                value: item.label,
                                id: item.value
                            };
                        }));
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    }   
                });
            },
            minLength: 2,
            select: function(event, ui) {         	                	
                //$('#empleado').val(ui.item.label);
                $('#empleado_id').val(ui.item.id);
            }
        });
	});
</script> 