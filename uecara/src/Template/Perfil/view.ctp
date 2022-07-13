<div class="perfil view large-12 medium-8 columns content">
	<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">
            	<i class="fas fa-user"></i> Perfil # <?= h($perfil->id) ?>
            	<?php if ($user["perfil_id"] !==3) { ?><div style="float:right;">
				<?= $this->Html->link(__('Lista Perfiles'), ['action' => 'index'], ['escape' => false]) ?>
				</div><?php } ?>
            </h6>
        </div>
        <div class="card-body">
            <table class="vertical-table">
                <tr>
                    <th scope="row" style="width:20%"><?= __('Nombre Perfil') ?></th>
                    <td><?= h($perfil->nombre_perfil) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Nivel') ?></th>
                    <td><?= $this->Number->format($perfil->nivel) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Usuarios relacionados') ?></h4>
                <?php if (!empty($perfil->users)): ?>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th scope="col"><?= __('Id') ?></th>
                        <th scope="col" width="250"><?= __('Email') ?></th>
                        <th scope="col"><?= __('Nombre') ?></th>
                        <th scope="col"><?= __('Apellido') ?></th>
                        <th scope="col"><?= __('Activo') ?></th>
                        <!-- <th scope="col"><?= __('Perfil Id') ?></th>-->
                        <th scope="col" width="100"><?= __('Creado') ?></th>
                        <th scope="col" width="100"><?= __('Modificado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                    </tr>
                    <?php foreach ($perfil->users as $users): ?>
                    <tr>
                        <td><?= h($users->id) ?></td>
                        <td><?= h($users->email) ?></td>
                        <td><?= h($users->nombre) ?></td>
                        <td><?= h($users->apellido) ?></td>
                        <td><?= $users->activo ? __('Si') : __('No'); ?></td>
                        <!-- <td><?= h($users->perfil_id) ?></td>-->
                        <td><?= h($users->created) ?></td>
                        <td><?= h($users->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fas fa-search')), 
                                ['controller' => 'Users', 'action' => 'view', $users->id],
                                ['escape'=>false,'title'=> __('Ver'),'class'=>'btn btn-info tiny']
                            ) ?>
                            <?php if ($user["perfil_id"] !==3) { ?>
                            <?= $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fas fa-edit')), 
                                ['controller' => 'Users', 'action' => 'edit', $users->id],
                                ['escape'=>false,'title'=> __('Editar'),'class'=>'btn btn-success tiny']
                            ) ?>
                            <?= $this->Form->postLink(
                                $this->Html->tag('i', '', array('class' => 'fas fa-trash-alt')), 
                                ['controller' => 'Users', 'action' => 'delete', $users->id],
                                ['escape'=>false,'title'=> __('Borrar'),'class'=>'btn btn-danger tiny'],
                                ['confirm' => __('Estas seguro de borrar # {0}?', $users->id)]
                            ) ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
