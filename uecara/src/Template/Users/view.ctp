<div class="users view large-10 medium-8 columns content">
	<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">
            	<i class="fas fa-user"></i> Usuario # <?= h($user->id);?>
            	<?php if ($user["perfil_id"] !==3) { ?>
					<div style="float:right;">
						<?= $this->Html->link(__('Lista Usuarios'), ['controller'=>'users','action' => 'index'], ['escape' => false]) ?>
					</div>
				<?php } ?>
            </h6>
        </div>
        <div class="card-body">
            <table class="vertical-table">
                <tr>
                    <th scope="row" style="width:20%"><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <!-- <tr>
                    <th scope="row"><?= __('Password') ?></th>
                    <td><?= h($user->password) ?></td>
                </tr>-->
                <tr>
                    <th scope="row"><?= __('Nombre') ?></th>
                    <td><?= h($user->nombre) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Apellido') ?></th>
                    <td><?= h($user->apellido) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Perfil') ?></th>
                    <td><?= $user->has('perfil') ? $this->Html->link($user->perfil->nombre_perfil, ['controller' => 'Perfil', 'action' => 'view', $user->perfil->id]) : '' ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Creado') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modificado') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Activo') ?></th>
                    <td><?= $user->activo ? __('Si') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
