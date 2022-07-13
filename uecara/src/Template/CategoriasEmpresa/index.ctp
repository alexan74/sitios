<div class="h3 mb-2 text-gray-800 tright"><?= $this->Html->link(__('Nueva Categoria'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-danger">Categorias</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('nombre') ?></th>
                <th><?= $this->Paginator->sort('activo') ?></th>
                <th><?= __('Acciones') ?></th>
              	</tr>
                </thead>
                <tfoot>
                <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('nombre') ?></th>
                <th><?= $this->Paginator->sort('activo') ?></th>
                <th><?= __('Acciones') ?></th>
              </tr>
                </tfoot>
                <tbody>
                <?php 
                if ($categorias->count()) { ?>
                    <?php foreach ($categorias as $item): ?>
                      <tr>
                        <td><?= $this->Number->format($item->id) ?></td>
                        <td><?= h($item->nombre) ?></td>
                        <td><?= $item->activo ? __('Si') : __('No'); ?></td>
                        <td class="actions" style="white-space:nowrap">
                        	<?= $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fas fa-search')), 
                        	    ['action' => 'view', $item->id],
                                ['escape'=>false,'title'=> __('Ver'),'class'=>'btn btn-info tiny']
                            ) ?>
                            <?= $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fas fa-edit')), 
                                ['action' => 'edit', $item->id],
                                ['escape'=>false,'title'=> __('Editar'),'class'=>'btn btn-success tiny']
                            ) ?>
                            <?= $this->Form->postLink(
                                $this->Html->tag('i', '', array('class' => 'fas fa-trash-alt')), 
                                ['action' => 'delete', $item->id],
                                ['escape'=>false,'title'=> __('Borrar'),'class'=>'btn btn-danger tiny',
                                    'confirm' => __('Estas seguro de borrar # {0}?', $item->id)
                                ]
                            ) ?>
                        </td>
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
        	if ($paginador['pageCount'] > 1) { ?>
          		<div class="fleft">Pagina:</div> 
      			<ul class="pagination pagination-sm no-margin pull-right">
        			<?php echo $this->Paginator->numbers(); ?>
      			</ul>
        	<?php } ?>
        </div>
    </div>
</div>
