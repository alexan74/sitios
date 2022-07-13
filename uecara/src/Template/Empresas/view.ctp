<div class="perfil view large-12 medium-8 columns content">
	<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">
            	<i class="fas fa-user"></i> Empresa # <?= h($empresa->id) ?>
            	<?php if ($user["perfil_id"] !==3) { ?><div style="float:right;">
				<?= $this->Html->link(__('Lista Empresas'), ['action' => 'index'], ['escape' => false]) ?>
				</div><?php } ?>
            </h6>
        </div>
        <div class="card-body">
            <table class="vertical-table">
                <tr>
                    <th scope="row"><?= __('Cuit') ?></th>
                    <td><?= h($empresa->cuit) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Password') ?></th>
                    <td><?= h($empresa->password) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Denom Social') ?></th>
                    <td><?= h($empresa->denom_social) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Calle') ?></th>
                    <td><?= h($empresa->calle) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Numero') ?></th>
                    <td><?= h($empresa->numero) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Piso') ?></th>
                    <td><?= h($empresa->piso) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Dpto') ?></th>
                    <td><?= h($empresa->dpto) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Barrio') ?></th>
                    <td><?= h($empresa->barrio) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Localidad') ?></th>
                    <td><?= h($empresa->localidad) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Provincia') ?></th>
                    <td><?= h($empresa->provincia) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Codpos') ?></th>
                    <td><?= h($empresa->codpos) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Telefono') ?></th>
                    <td><?= h($empresa->telefono) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Fax') ?></th>
                    <td><?= h($empresa->fax) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Email') ?></th>
                    <td><?= h($empresa->email) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($empresa->id) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Tipo de Empresa') ?></th>
                    <td><?= h($empresa->tipos_empresa['tipo']) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Cant Sucurs') ?></th>
                    <td><?= $this->Number->format($empresa->cant_sucurs) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Total Emp') ?></th>
                    <td><?= $this->Number->format($empresa->total_emp) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Fecha') ?></th>
                    <td><?= h($empresa->fecha) ?></td>
                </tr>
                <!-- <tr>
                    <th scope="row"><? //= __('Observaciones') ?></th>
                    <td><? //= h($empresa->observaciones) ?></td>
                </tr>-->
            </table>
            <div class="related">
            	<?php if (!empty($empresa->tramites)): ?>
                <h4><?= __('Tramites') ?></h4>             
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th scope="col"><?= __('Tipo de tramite') ?></th>
                        <th scope="col"><?= __('Fecha') ?></th>
                        <th scope="col"><?= __('Documentación') ?></th>
                        <th scope="col"><?= __('Observaciones') ?></th>
                    </tr>
                    <?php foreach ($empresa->tramites as $tramite): ?>
                    <tr>
                    	<td><?= $tramite->tipo_tramite ?></td>
                    	<td><?= (!empty($tramite->fecha))?$tramite->fecha->format('d/m/Y'):'' ?></td>
                    	<td>
                    		<?php if (!empty($tramite->archivos)) {
                    		    $archivos = '';
                    		    foreach ($tramite->archivos as $archivo) {
                    		        $archivos .= '<i class="fas fa-angle-right"></i> '.$this->Html->link($archivo->nombre, ['action' => 'download', $archivo->id], ['escape' => false]).'<br />';
                    		    }
                    		    echo $archivos;
                    		} ?>
                    	</td>
                        <td><?= $tramite->observaciones ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
            <div class="related">
            	<?php if (!empty($empresa->nominas)): ?>
                <h4><?= __('Nominas') ?></h4>            
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th scope="col"><?= __('Id') ?></th>
                        <th scope="col"><?= __('Apellido') ?></th>
                        <th scope="col"><?= __('Nombre') ?></th>
                        <th scope="col"><?= __('Categoria') ?></th>
                        <th scope="col"><?= __('Cuota Sindical') ?></th>
                    </tr>
                    <?php foreach ($empresa->nominas as $nominas): ?>
                    <tr>
                        <td><?= h($nominas->id) ?></td>
                        <td><?= h($nominas->apellido) ?></td>
                        <td><?= h($nominas->nombre) ?></td>
                        <td><?= h($nominas->categoria) ?></td>
                        <td><?= ($nominas->cuota_sindical)?'Si':'No'; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
