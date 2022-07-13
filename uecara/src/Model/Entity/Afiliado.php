<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Afiliado Entity
 *
 * @property int $id
 * @property int|null $nro_afiliado
 * @property string|null $nomyape
 * @property \Cake\I18n\FrozenTime|null $fecha_nac
 * @property string|null $cuil
 * @property string|null $telefono
 * @property string|null $direccion
 * @property string|null $email
 * @property int|null $empresa_id
 * @property int|null $tipo_empresa_id
 * @property string|null $tipo_contratacion
 * @property \Cake\I18n\FrozenTime|null $fecha_ingreso_afiliado
 * @property \Cake\I18n\FrozenTime|null $fecha_baja_sindicato
 * @property string|null $telefono_empresa
 * @property string|null $email_empresa
 * @property string|null $observaciones
 * @property \Cake\I18n\FrozenTime|null $fecha_ingreso_empresa
 * @property int|null $categoria_id
 * @property string|null $retiro_carnet
 * @property int|null $baja
 *
 * @property \App\Model\Entity\Empresa $empresa
 * @property \App\Model\Entity\TiposEmpresa $tipos_empresa
 * @property \App\Model\Entity\CategoriasEmpresa $categorias_empresa
 */
class Afiliado extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'nro_afiliado' => true,
        'nomyape' => true,
        'fecha_nac' => true,
        'cuil' => true,
        'telefono' => true,
        'direccion' => true,
        'email' => true,
        'empresa_id' => true,
        'tipo_empresa_id' => true,
        'tipo_contratacion' => true,
        'fecha_ingreso_afiliado' => true,
        'fecha_baja_sindicato' => true,
        'telefono_empresa' => true,
        'email_empresa' => true,
        'observaciones' => true,
        'fecha_ingreso_empresa' => true,
        'categoria_id' => true,
        'retiro_carnet' => true,
        'baja' => true,
        'tramite_id'=>true,
        'empresa' => true,
        'tipos_empresa' => true,
        'categorias_empresa' => true
    ];
}
