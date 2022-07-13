<div class="perfil view large-12 medium-8 columns content">
	<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">
            	<i class="fas fa-user"></i> Afiliado <?= h($afiliado->nomyape) ?>
            	<?php if ($user["perfil_id"] !==3) { ?><div style="float:right;">
				<?= $this->Html->link(__('Lista Afiliados'), ['action' => 'index'], ['escape' => false]) ?>
				</div><?php } ?>
            </h6>
        </div>
        <div class="card-body">
        <table class="vertical-table">
            <tr>
                <th scope="row"><?= __('Nro Afiliado') ?></th>
                <td><?= $afiliado->nro_afiliado ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Nombre y Apellido') ?></th>
                <td><?= h($afiliado->nomyape) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Fecha Nacimiento') ?></th>
                <td><?= !empty($afiliado->fecha_nac)?h($afiliado->fecha_nac->format('d/m/Y')):'' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Cuil') ?></th>
                <td><?= h($afiliado->cuil) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Telefono') ?></th>
                <td><?= h($afiliado->telefono) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Direccion') ?></th>
                <td><?= h($afiliado->direccion) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Email') ?></th>
                <td><?= h($afiliado->email) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Empresa') ?></th>
                <td><?php echo $afiliado->empresa->denom_social;?></td>
                <!-- <td><? //= $afiliado->has('empresa') ? $this->Html->link($afiliado->empresa->denom_social, ['controller' => 'Empresas', 'action' => 'view', $afiliado->empresa->id]) : '' ?></td>-->
            </tr>
            <tr>
                <th scope="row"><?= __('Tipo de Empresa') ?></th>
                <td><?php echo $afiliado->tipos_empresa->tipo;?></td>
                <!-- <td><? //= $afiliado->has('tipos_empresa') ? $this->Html->link($afiliado->tipos_empresa->id, ['controller' => 'TiposEmpresa', 'action' => 'view', $afiliado->tipos_empresa->id]) : '' ?></td>-->
            </tr>
            <tr>
                <th scope="row"><?= __('Tipo de Contratacion') ?></th>
                <td><?= h($afiliado->tipo_contratacion) ?></td>
            </tr>
             <tr>
                <th scope="row"><?= __('Fecha Ingreso al Afiliado') ?></th>
                <td><?= !empty($afiliado->fecha_ingreso_afiliado)?h($afiliado->fecha_ingreso_afiliado->format('d/m/Y')):'' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Fecha Baja de Sindicato') ?></th>
                <td><?= !empty($afiliado->fecha_baja_sindicato)?h($afiliado->fecha_baja_sindicato->format('d/m/Y')):'' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Telefono de Empresa') ?></th>
                <td><?= h($afiliado->telefono_empresa) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Email de Empresa') ?></th>
                <td><?= h($afiliado->email_empresa) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Observaciones') ?></th>
                <td><?= h($afiliado->observaciones) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Fecha Ingreso a la Empresa') ?></th>
                <td><?= !empty($afiliado->fecha_ingreso_empresa)?h($afiliado->fecha_ingreso_empresa->format('d/m/Y')):'' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Categoria de Empresa') ?></th>
                <td><?php echo $afiliado->categorias_empresa->nombre;?></td>
                <!-- <td><? //= $afiliado->has('categorias_empresa') ? $this->Html->link($afiliado->categorias_empresa->id, ['controller' => 'CategoriasEmpresa', 'action' => 'view', $afiliado->categorias_empresa->id]) : '' ?></td>-->
            </tr>
            <tr>
                <th scope="row"><?= __('Retiro de Carnet') ?></th>
                <td><?= ($afiliado->retiro_carnet)?"Si":"No" ?></td>
            </tr>
            <?php if (!empty($afiliado->tramite)) { 
                $archivos = $afiliado->tramite->archivos;
                if (!empty($archivos)) {
            ?>
                <tr>
                    <th scope="row"><?= __('Archivos de baja') ?></th>
                    <td><?php //= $this->Html->link($archivo->nombre, ['action' => 'download', $archivo->id])
                		    $lista = '';
                		    foreach ($archivos as $archivo) {
                		        $lista .= '<i class="fas fa-angle-right"></i> '.$this->Html->link($archivo->nombre, ['controller'=>'empresas','action' => 'download', $archivo->id], ['escape' => false]).'<br />';
                		    }
                		    echo $lista;
                		?>
                    </td>
                </tr>
            	<?php } ?>
            <tr>
                <th scope="row"><?= __('Observación de baja') ?></th>
                <td><?= h($afiliado->tramite->observaciones) ?></td>
            </tr>
            <?php } ?>
        </table>
   	</div>
</div>
