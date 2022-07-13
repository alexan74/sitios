<!-- Page Heading -->
<!--h1 class="h3 mb-2 text-gray-800">Empresas</h1-->
<div class="h3 mb-2 text-gray-800 tright"><?= $this->Html->link(__('Nueva Empresa'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>

<!--p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p-->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-2">
        <h4 class="m-0 font-weight-bold text-danger">Empresas</h4>
    </div>
    <div style="clear:both;"><br /></div>
    <div class="card border-bottom-danger col-sm-12"> 
        <div class="card shadow mb-4">
            <div class="card-header py-2">
            	<b><?= __('Busqueda') ?></b>
            </div>
            <div class="card-body">
            	
                <?= $this->Form->create($empresas, array('role' => 'form',"class" => "user")) ?>
                <div class="form-group"> 
                	<label class="control-label col-sm-2">Denominación Social</label>
                   	<div class="col-sm-6">
                   		<input type="text" name="denom_social"  value="<?php echo $denom_social;?>">
                   	</div>
                </div>
                <div class="form-group" > 
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
                <!-- <th><? //= $this->Paginator->sort('id') ?></th>-->
                <th><?= $this->Paginator->sort('cuit') ?></th>
                <th><?= $this->Paginator->sort('fecha') ?></th>
                <!-- <th><?php //echo $this->Paginator->sort('password') ?></th>-->
                <th><?= $this->Paginator->sort('denom_social') ?></th>
                <th><?= $this->Paginator->sort('calle') ?></th>
                <th><?= $this->Paginator->sort('numero') ?></th>
                <th>Tipo de empresa</th>
                <th>Archivos Subidos</th>
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
                <!-- <th><? //= $this->Paginator->sort('id') ?></th>-->
                <th><?= $this->Paginator->sort('cuit') ?></th>
                <th><?= $this->Paginator->sort('fecha') ?></th>
                <!-- <th><?php //echo $this->Paginator->sort('password') ?></th>-->
                <th><?= $this->Paginator->sort('denom_social') ?></th>
                <th><?= $this->Paginator->sort('calle') ?></th>
                <th><?= $this->Paginator->sort('numero') ?></th>
                <th>Tipo de empresa</th>
                <th>Archivos Subidos</th>
                <th><?= __('Acciones') ?></th>
              </tr>
                </tfoot>
                <tbody>
                <?php 
                if ($empresas->count()) { 
                    foreach ($empresas as $empresa): ?>
                  	<tr>
                    <!-- <td><? //= $this->Number->format($empresa->id) ?></td>-->
                    <td><?= h($empresa->cuit) ?></td>
                    <td><?= $empresa->fecha->format('d/m/Y') ?></td>
                    <!-- <td><?php //h($empresa->password) ?></td>-->
                    <td><?= h($empresa->denom_social) ?></td>
                    <td><?= h($empresa->calle) ?></td>
                    <td><?= h($empresa->numero) ?></td>
                    <td><?= h($empresa->TiposEmpresa['tipo']) ?></td>
                    <td>
                    	<?php if (!empty($empresa->tramites)) {
                    	    $archivos = '';
                    	    foreach ($empresa->tramites as $tramite) {
                    	        if (!empty($tramite->archivos)) {
                    	            foreach ($tramite->archivos as $archivo) {
                    	               $archivos .= '<i class="fas fa-angle-right"></i> '.$this->Html->link($archivo->nombre, ['action' => 'download', $archivo->id], ['escape' => false]).'<br />';
                    	            }
                    	        }
                    	    }
                    	    echo $archivos;
                    	} ?>
					</td>
                    <td class="actions" style="white-space:nowrap">
                	<?= $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fas fa-search')), 
                	    ['action' => 'view', $empresa->id],
                        ['escape'=>false,'title'=> __('Ver'),'class'=>'btn btn-info tiny']
                    ) ?>
                    <?= $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fas fa-edit')), 
                        ['action' => 'edit', $empresa->id],
                        ['escape'=>false,'title'=> __('Editar'),'class'=>'btn btn-success tiny']
                    ) ?>
                    <?= $this->Form->postLink(
                        $this->Html->tag('i', '', array('class' => 'fas fa-trash-alt')), 
                        ['action' => 'delete', $empresa->id],
                        ['escape'=>false,'title'=> __('Borrar'),'class'=>'btn btn-danger tiny',
                            'confirm' => __('Estas seguro de borrar la de cuit {0}?', $empresa->cuit)
                        ]
                    ) ?>
                    </td>
                  	</tr>
            		<?php endforeach; 
                }  else { ?>
                	<tr><td colspan="6">No hay resultado que mostrar</td></tr>
                <?php } ?> 
                    
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
