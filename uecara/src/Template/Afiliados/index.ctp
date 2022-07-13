<?php //debug($baja);?>
<!-- Page Heading -->
<!--h1 class="h3 mb-2 text-gray-800">Afiliados</h1-->
<div class="h3 mb-2 text-gray-800 tright"><?= $this->Html->link(__('Nuevo Afiliado'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>

<!--p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p-->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Afiliados</h6>
    </div>
    <div style="clear:both;"><br /></div>
    <div class="card border-bottom-danger col-sm-12"> 
        <div class="card shadow mb-4">
            <div class="card-header py-2">
            	<b><?= __('Busqueda') ?></b>
            </div>
            <div class="card-body">  	
                <?= $this->Form->create($afiliados, array('role' => 'form',"class" => "user")) ?>
                <div class="form-group col-sm-12">
                	<div class="col-sm-6"> 
                    	<label class="control-label col-sm-2">Nro. Afiliado</label>
                       	<div class="col-sm-6">
                       		<input type="text" name="nro_afiliado"  value="<?php echo $nro_afiliado;?>">
                       	</div>
                    </div>
                   	<div class="col-sm-6"> 
                    	<label class="control-label col-sm-3">Nombre y Apellido</label>
                       	<div class="col-sm-5">
                       		<input type="text" name="nomyape"  value="<?php echo $nomyape;?>">
                       	</div>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                	<div class="col-sm-6"> 
                    	<label class="control-label col-sm-2">Empresa</label>
                       	<div class="col-sm-6">
                       		<?php echo $this->Form->input('empresa_id', ['options' => $empresas, "empty" => true, "label"=>false, "class" => "form-control", "value"=>$empresa_id]); ?>
                       	</div>
                    </div>
                   	<div class="col-sm-6"> 
                    	<label class="control-label col-sm-3">Tipo de Empresa</label>
                       	<div class="col-sm-5">
                       		<?php echo $this->Form->input('tipo_empresa_id', ['options' => $tipos, "empty" => true, "label"=>false, "class" => "form-control", "value"=>$tipo_empresa_id]); ?>
                       	</div>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                	<div class="col-sm-4"> 
                    	<label class="control-label col-sm-4">Tipo Contratacion</label>
                       	<div class="col-sm-6">
                       		<select name="tipo_contratacion">
                        		<option value=""></option>
                        		<option value="temporario" <?php echo ($tipo_contratacion=="temporario")?" selected ":"";?>>Temporario</option>
                        		<option value="permanente" <?php echo ($tipo_contratacion=="permanente")?" selected ":"";?>>Permanente</option>
                        	</select>
                       	</div>
                    </div>
                   	<div class="col-sm-4"> 
                    	<label class="control-label col-sm-4">Retiro de Carnet</label>
                       	<div class="col-sm-6">
                       		<input type="radio" name="retiro_carnet" value="1" <?php echo ($retiro_carnet==1)?" checked ":"";?>> Si  
                  			&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;
                  			<input  type="radio" name="retiro_carnet" value="0" <?php echo ($retiro_carnet==0 && isset($retiro_carnet))?" checked ":"";?>> No
                       	</div>
                    </div>
                    <div class="col-sm-4"> 
                    	<label class="control-label col-sm-2">Baja</label>
                       	<div class="col-sm-6">
                       		<input type="radio" name="baja" value="1" <?php echo ($baja==1)?" checked ":"";?>> Si  
                  			&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;
                  			<input  type="radio" name="baja" value="0" <?php echo ($baja==0 && isset($baja))?" checked ":"";?>> No
                       	</div>
                    </div>
                </div>
                <div class="form-group col-sm-12" > 
                  	<div class="offset-4 col-sm-10">
                    	<?= $this->Form->button('<i class="fas fa-search"></i> '.__('Buscar'),["class" => "btn btn-success","style"=>"margin:0;"]) ?>
                    	<?= $this->Html->link('<i class="fas fa-sync"></i> '.__('Limpiar'), ['action' => 'index','inicio'=>1], ['escape' => false,"class" => "btn btn-danger"]) ?>
                  	</div>
                </div>
                <?= $this->Form->end() ?>  
        	</div>              
    	</div>      
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th><?= $this->Paginator->sort('nro_afiliado') ?></th>
                <th><?= $this->Paginator->sort('nomyape') ?></th>
                <th><?= $this->Paginator->sort('fecha_nac') ?></th>
                <th><?= $this->Paginator->sort('cuil') ?></th>
                <th><?= $this->Paginator->sort('telefono') ?></th>
                <th><?= $this->Paginator->sort('direccion') ?></th>
                <th><?= __('Acciones') ?></th>
              </tr>
                    <!--tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr-->
                </thead>
                <tfoot>
                <tr>
                <th><?= $this->Paginator->sort('nro_afiliado') ?></th>
                <th><?= $this->Paginator->sort('nomyape') ?></th>
                <th><?= $this->Paginator->sort('fecha_nac') ?></th>
                <th><?= $this->Paginator->sort('cuil') ?></th>
                <th><?= $this->Paginator->sort('telefono') ?></th>
                <th><?= $this->Paginator->sort('direccion') ?></th>
                <th><?= __('Acciones') ?></th>
              </tr>
                </tfoot>
                <tbody>
                <?php foreach ($afiliados as $afiliado): ?>
              <tr>
                <td><?= $afiliado->nro_afiliado ?></td>
                <td><?= h($afiliado->nomyape) ?></td>
                <td><?= h($afiliado->fecha_nac) ?></td>
                <td><?= h($afiliado->cuil) ?></td>
                <td><?= h($afiliado->telefono) ?></td>
                <td><?= h($afiliado->direccion) ?></td>
                <td class="actions" style="white-space:nowrap">
                	<?= $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fas fa-search')), 
                	    ['action' => 'view', $afiliado->id],
                        ['escape'=>false,'title'=> __('Ver'),'class'=>'btn btn-info tiny']
                    ) ?>
                    <?php if (!$afiliado->baja) { ?>
                    <?= $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fas fa-edit')), 
                        ['action' => 'edit', $afiliado->id],
                        ['escape'=>false,'title'=> __('Editar'),'class'=>'btn btn-success tiny']
                    ) ?>
                    <?php /*= $this->Form->postLink(
                        $this->Html->tag('i', '', array('class' => 'fas fa-trash-alt')), 
                        ['action' => 'delete', $afiliado->id],
                        ['escape'=>false,'title'=> __('Borrar'),'class'=>'btn btn-danger tiny',
                            'confirm' => __('Estas seguro de borrar el afiliado nro {0}?', $afiliado->nro_afiliado)
                        ]
                    ) */?>
                    <a class="btn btn-danger tiny borrar" data-title="Baja de afiliado" href="<?=DIRHOST?>/afiliados/delete/<?php echo @$afiliado->id?>"><i class="fas fa-trash-alt"></i></a>
                    <?php } ?>
                </td>
              </tr>
            <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
        	<?php
        	$paginador = $this->Paginator->params();
        	if ($paginador['pageCount'] > 1) { ?>
          		<div class="fleft">Pagina:</div> 
      			<ul class="pagination pagination-sm no-margin pull-right">
        			<?php echo $this->Paginator->numbers(); ?>
      			</ul>
        	<?php } ?>
        </div>
    </div>
</div>
<div id="dialogModal" style="display:none">
	<div id="contentWrap"></div>
</div>
<style type="text/css">
    .modal-header .close {
        right: 15px;
        position: absolute;
    }
    button.close:hover {
        background-color:transparent;
    }
</style>
<script type="text/javascript">
$(document).ready(function() {
    //prepare the dialog
    var dialog = $( "#dialogModal" ).dialog({
        autoOpen: false,
        width: 700,
        //height: 500,
        autoResize:true,
        show: {
            effect: "slide",
            duration: 10
            },
        hide: {
            effect: "slide",
            duration: 10
            },
        modal: true,
        close: function(event, ui) {
          
        }
    });
    dialog.data( "uiDialog" )._title = function(title) {
        title.html( this.options.title );
    }

    var csrfToken = getCookie('csrfToken');
    $(".borrar").on("click", function(event) {
    	event.preventDefault();
        var link = $(this).attr("href");
        var title = $(this).data("title");
        $('#contentWrap').load( link, function( response, status, xhr ) {
            xhr.setRequestHeader('X-CSRF-Token', csrfToken);
            if ( status == "error" ) {
                 $('#dialogModal').dialog('close');
                 //window.top.location.href = '/login';
            }else{
                $('#dialogModal').dialog('option', 'title',' <span class="fas fa-eraser"></span> '+title);
                $('#dialogModal').dialog('open');  //open the dialog
            }
            
        });

    });
});
function getCookie(name) {
    var cookieValue = null;
    if (document.cookie && document.cookie !== '') {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = jQuery.trim(cookies[i]);
            // Does this cookie string begin with the name we want?
            if (cookie.substring(0, name.length + 1) === (name + '=')) {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                break;
            }
        }
    }
    return cookieValue;
}
</script>
