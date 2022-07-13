<?php
$usuario = $this->request->getSession()->read('Auth.User');
?>
<div style="background-color:aliceblue;"  data-topbar role="navigation">
    <h4 align="center">Viaticos 
     <?php if ($usuario['tipo_usuario']==2) { ?>
     	<button  class="btn btn-success pull-right tiny"  onclick="location.href='/viaticos/add/'" ><i class="fas fa-plus"></i> Viatico</button> 
     <?php } ?>
    </h4>
</div>
<fieldset>
    <form method="post" action="/viaticos/index/">
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
            <div class="col-sm-4">
            	<label class="col-sm-2 float">Carga</label>
            	<div class="col-sm-9 float">
                	<select name="carga">
                		<option value="" <?php if($carga==-1) echo " selected ";?>>Todos</option>
                		<option value="1"<?php if($carga==1) echo " selected ";?>>Automático</option>
                		<option value="0"<?php if($carga==0) echo " selected ";?>>Manual</option>
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
       	</div>
       	<?php if ($usuario['tipo_usuario']!=2) { ?>
   		<div class="row">
            <div class="col-sm-6">
            	<label class="col-sm-2 float">Empleados</label>
                <div class="col-sm-9 float">
                   	<!-- <input type="text" name="empleado" id="empleado" autocomplete="off" value="<?php //echo $empleado;?>" class="form-control">
                   	<input type="hidden" name="empleado_id" id="empleado_id" autocomplete="off" value="<?php //echo $empleado_id;?>">-->
                   	<select id="empleado_id" name="empleado_id" class="form-control">
                   		<option value=""></option>             
                    	<?php foreach ($empleados as $empleado): ?>
                        <option value="<?php echo $empleado->id; ?>"
                        <?php if ($empleado->id==$empleado_id) echo " selected "; ?>
                        ><?php echo $empleado->nombre." ".$empleado->apellido; ?></option>
                    	<?php endforeach; ?>
                	</select>
                </div>
            </div>
    	</div>
    	<?php } ?>
        <br />
        <div class="row">    
            <div class="col-sm-12 offset-sm-4"> 
                <div class="col-sm-2 float">          
                    <button type="submit" class="btn btn-primary" ><i class="fas fa-search"></i> Buscar</button>
                </div>
                <div class="col-sm-2 float">
                    <a href="/viaticos/limpiar/" class="btn btn-secondary"><i class="fas fa-broom"></i> Limpiar</a>
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
                <th width="200px"  scope="col">Empleado</th>
                <th width="200px"scope="col">Descripcion</th>
                <th width="80px"scope="col">Valor</th>
                <th width="80px"scope="col">Carga</th>
                <th width="80px"scope="col">pagado <!-- <input type="checkbox" onclick="apagar()" id="apagar" value="1" />--></th>
                <th width="30px"scope="col" ><?= __('Ver') ?></th>
                <?php if ($usuario['tipo_usuario']!=1) { ?>
                <th width="30px"scope="col" ><?= __('Acción') ?></th>
                <th width="30px" scope="col" ><?= __('Eliminar') ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalapagar=0;
            foreach ($viaticos as $viatico): ?>
            <tr>               
            	<td><?= h(date('d/m/Y',strtotime($viatico->fecha))) ?></td>
                <td><?= h($viatico->user->nombre." ".$viatico->user->apellido ) ?></td>
                <td><?= h($viatico->descripcion) ?></td>
                <td><span id="valor" data-valor="<?=$viatico->valor;?>"><?= h(number_format($viatico->valor,2,',','.')) ?></span></td>
                <td><?= h(($viatico->carga)?"Automatico":"Manual") ?></td>
                <td>
                <?php if ($usuario['tipo_usuario']==2) { ?>
				<?= h(($viatico->pagado)?"Si":"No") ?></td>
                <?php } else { ?>
                	<input id="chk_pagado" type="checkbox" value="1" name="chk_pagado" class="chk_pagado" data-id="<?= $viatico->id ?>" <?= ($viatico->pagado)?" checked disabled":"" ?> />
                <?php } ?>
                <td class="actions">
                    <button type="button" onclick="window.location.href='/viaticos/view/<?= $viatico->id ?>'"  class="btn btn-info tiny"> <i class="fas fa-search"></i></button>
                </td>
                <?php if ($usuario['tipo_usuario']!=1) { ?>  
                <td class="actions">
                    <button type="button" onclick="window.location.href='/viaticos/edit/<?= $viatico->id ?>'"  class="btn btn-success tiny"> <i class="fas fa-edit"></i></button>
                </td>  
                <?php //if ($usuario['tipo_usuario']!=2) { ?>
                <td class="actions">
                	<?php if ((!$viatico->carga && !$viatico->pagado) || ($viatico->carga && $viatico->pagado && empty($viatico->tarea_id))) { ?>
                    <form method="post" action="/viaticos/delete/<?= $viatico['id']; ?>">
                    <button class="btn btn-danger tiny"  onclick="return confirm('Estás seguro que deseas eliminar la tarea #<?= $viatico['id']; ?> ');"  type="submit" value="Eliminar"><i class="fas fa-trash-alt"></i></button>
                    </form>
                    <?php } ?>
                </td>
                <?php } ?>
            </tr>
            <?php
            if (!$viatico->pagado) {
                $totalapagar += $viatico->valor;    
            } ?>
			<?php endforeach;?> 
        </tbody>
        <?php if ($usuario['tipo_usuario']==1) { ?>
        <tfoot>
        	<tr>
        		<td colspan="<?= ($usuario['tipo_usuario']!=1)?9:7;?>"> A PAGAR <span style="color:red" id="total">$ <?php echo number_format($totalapagar,2,',','.');?></span>&nbsp;&nbsp;
        		<button type="button" class="btn btn-success" onclick="pagar()"><i class="fas fa-coins"></i> Pagar</button>
        		</td>
        	</tr>
        </tfoot>
        <?php } ?>
    </table>
    <br />
</div>

<script type="text/javascript">
    $(function () {
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
        
         $(".chk_pagado").change(function() {
         	var valor = ($(this).is(":checked"))?1:0;
         	//alert(valor);
         	var id = $(this).data("id");
         	if (id && id !== 'undefined') {
             	$.ajax({
                    url: "/viaticos/setPagado/",
                    type: 'POST',
                    dataType: 'json',
                    data: {valor: valor, id: id},
                    success: function (data) {
                    	var total=0;
                    	$('input[name=chk_pagado]:not(:checked)').each(function() {
            				total += ($(this).closest('tr').find('span#valor').data('valor'));
            				
            			});
            			$('#total').text('$ '+ total);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    }   
                }); 
           	}
         });
	});
	function pagar() {
		var total=0;
		$('input[name=chk_pagado]:not(:checked)').each(function() {
       		total += ($(this).closest('tr').find('span#valor').data('valor'));			
        });
        
    	bootbox.confirm({
            message: "Realizara un pago de viáticos a <?php echo $usuario['nombre']." ".$usuario['apellido']; ?> por el valor de $"+total+" a pagar. ¿Está seguro que desea realizar el pago ? ",
            buttons: {
                confirm: {
                    label: 'Si',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                	$.ajax({
                        url: "/viaticos/aPagar/",
                        type: 'POST',
                        dataType: 'json',
                        data: {empleado_id: $('#empleado_id').val()},
                        success: function (data) {
                        	alert("Ha sido pagado correctamente");
                        	location.reload();
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                        }   
                    }); 
               	}
            }
		});
    }
    
    function apagar() {
    	alert("jkbkj");
    	return false;
    }
</script> 