<div class="container home">
	<div class="card o-hidden border-0 shadow-lg my-5">
		<div class="card-body">
    		<div class="h3 mb-2 text-gray-800 tright"><?= $this->Html->link(__('Volver'), ['action' => 'index'], ['class' => 'btn btn-danger btn-xs']) ?></div>       
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-danger">Mis Tramites</h4>
            </div>
        
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                    <!-- <th><? //= $this->Paginator->sort('id') ?></th>-->
                    <th>Tipo de Tramite</th>
                    <th>Fecha Alta</th>
                    <th>Documentación</th>
                    <th>Observaciones</th>
                  	</tr>
                    </thead>
                    <tfoot>
                    <tr>
                    <!-- <th><? //= $this->Paginator->sort('id') ?></th>-->
                    <th>Tipo de Tramite</th>
                    <th>Fecha Alta</th>
                    <th>Documentación</th>
                    <th>Observaciones</th>
                  	</tr>
                    </tfoot>
                    <tbody>
                    <?php 
                    if ($tramites->count()) { ?>
                        <?php foreach ($tramites as $item): ?>
                          <tr>
                            <!-- <td><? //= $this->Number->format($item->id) ?></td>-->
                            <td><?= h($item->tipo_tramite) ?></td>
                            <td><?= (!empty($item->fecha))?$item->fecha->format('d/m/Y'):'' ?></td>
                            <td><?php if (!empty($item->archivos)) { 
                                foreach ($item->archivos as $archivo) {
                        	        echo '<i class="fas fa-angle-right"></i> '.$this->Html->link($archivo->nombre, ['controller'=>'Empresas', 'action' => 'download', $archivo->id], ['escape' => false]).'<br />'; 
                        	    } 
                        	} ?></td>       
                            <td><?= @h($item->observaciones) ?></td>
                          </tr>
                        <?php endforeach; ?>
                    <?php } else { ?>
                    	<tr><td colspan="4">No hay resultado que mostrar</td></tr>
                    <?php } ?> 
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
            	<?php
            	$paginador = $this->Paginator->params();
    
            	if (!empty($paginador) && $paginador['page'] > 1) { ?>
              		<div class="fleft">Pagina:</div> 
          			<ul class="pagination pagination-sm no-margin pull-right">
            			<?php echo $this->Paginator->numbers(); ?>
          			</ul>
            	<?php } ?>
            </div>
        </div>
	</div>
</div>
