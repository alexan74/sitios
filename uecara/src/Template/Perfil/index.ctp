<div class="h3 mb-2 text-gray-800 tright"><?= $this->Html->link(__('Nuevo Perfil'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-danger">Perfil</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('nombre_perfil') ?></th>
                <th><?= $this->Paginator->sort('nivel') ?></th>
                <th><?= __('Acciones') ?></th>
              	</tr>
                </thead>
                <tfoot>
                <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('nombre_perfil') ?></th>
                <th><?= $this->Paginator->sort('nivel') ?></th>
                <th><?= __('Acciones') ?></th>
              </tr>
                </tfoot>
                <tbody>
                <?php foreach ($perfil as $perfil): ?>
              <tr>
                <td><?= $this->Number->format($perfil->id) ?></td>
                <td><?= h($perfil->nombre_perfil) ?></td>
                <td><?= $this->Number->format($perfil->nivel) ?></td>
                <td class="actions" style="white-space:nowrap">
                	<?= $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fas fa-search')), 
                	    ['action' => 'view', $perfil->id],
                        ['escape'=>false,'title'=> __('Ver'),'class'=>'btn btn-info tiny']
                    ) ?>
                    <?= $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fas fa-edit')), 
                        ['action' => 'edit', $perfil->id],
                        ['escape'=>false,'title'=> __('Editar'),'class'=>'btn btn-success tiny']
                    ) ?>
                    <?= $this->Form->postLink(
                        $this->Html->tag('i', '', array('class' => 'fas fa-trash-alt')), 
                        ['action' => 'delete', $perfil->id],
                        ['escape'=>false,'title'=> __('Borrar'),'class'=>'btn btn-danger tiny',
                            'confirm' => __('Estas seguro de borrar # {0}?', $perfil->id)
                        ]
                    ) ?>
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
