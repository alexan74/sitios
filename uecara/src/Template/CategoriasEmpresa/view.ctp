<div class="perfil view large-10 medium-8 columns content">
	<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">
            	<i class="fas fa-user"></i> Categoria # <?= h($categoria->id) ?>
            	<?php if ($user["perfil_id"] !==3) { ?><div style="float:right;">
				<?= $this->Html->link(__('Lista Categorias'), ['action' => 'index'], ['escape' => false]) ?>
				</div><?php } ?>
            </h6>
        </div>
        <div class="card-body">
            <table class="vertical-table">
                <tr>
                    <th scope="row" style="width:20%"><?= __('Nombre') ?></th>
                    <td><?= h($categoria->nombre) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Observaciones') ?></th>
                    <td><?= h($categoria->observaciones) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Activo') ?></th>
                    <td><?= $categoria->activo ? __('Si') : __('No'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>
