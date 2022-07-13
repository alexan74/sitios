<div class="h3 mb-2 text-gray-800 tright"><?= $this->Html->link(__('Nuevo Usuario'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-danger">Usuarios</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('nombre') ?></th>
                <th><?= $this->Paginator->sort('apellido') ?></th>
                <th><?= $this->Paginator->sort('activo') ?></th>
                <th><?= $this->Paginator->sort('perfil_id') ?></th>
                <th><?= __('Acciones') ?></th>
              	</tr>
                </thead>
                <tfoot>
                <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('nombre') ?></th>
                <th><?= $this->Paginator->sort('apellido') ?></th>
                <th><?= $this->Paginator->sort('acivo') ?></th>
                <th><?= $this->Paginator->sort('perfil_id') ?></th>
                <th><?= __('Acciones') ?></th>
              </tr>
                </tfoot>
                <tbody>
                <?php foreach ($users as $user): ?>
              <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->nombre) ?></td>
                <td><?= h($user->apellido) ?></td>
                <td><?= h($user->activo) ?></td>
                <td><?= h($user->perfil->nombre_perfil) ?></td>
                <!--td><?php //$user->has('perfil') ? $this->Html->link($user->perfil->id, ['controller' => 'Perfil', 'action' => 'view', $user->perfil->id]) : '' ?></td-->
                <td class="actions" style="white-space:nowrap">
                	<?= $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fas fa-search')), 
                        ['action' => 'view', $user->id],
                        ['escape'=>false,'title'=> __('Ver'),'class'=>'btn btn-info tiny']
                    ) ?>
                    <?= $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fas fa-edit')), 
                        ['action' => 'edit', $user->id],
                        ['escape'=>false,'title'=> __('Editar'),'class'=>'btn btn-success tiny']
                    ) ?>
                    <?= $this->Form->postLink(
                        $this->Html->tag('i', '', array('class' => 'fas fa-trash-alt')), 
                        ['action' => 'delete', $user->id],
                        ['escape'=>false,'title'=> __('Borrar'),'class'=>'btn btn-danger tiny',
                            'confirm' => __('Estas seguro de borrar # {0}?', $user->id)
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
