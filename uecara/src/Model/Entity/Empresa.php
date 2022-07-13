<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Empresa Entity
 *
 * @property int $id
 * @property string $cuit
 * @property \Cake\I18n\FrozenTime|null $fecha
 * @property string $password
 * @property string $denom_social
 * @property string|null $calle
 * @property string|null $numero
 * @property string|null $piso
 * @property string|null $dpto
 * @property string|null $barrio
 * @property string|null $localidad
 * @property string|null $provincia
 * @property string|null $codpos
 * @property string|null $telefono
 * @property string|null $fax
 * @property string|null $email
 * @property int|null $cant_sucurs
 * @property int|null $total_emp
 *
 * @property \App\Model\Entity\Nomina[] $nominas
 */
class Empresa extends EmpresaEnttity
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
        'cuit' => true,
        'fecha' => true,
        'password' => true,
        'denom_social' => true,
        'calle' => true,
        'numero' => true,
        'piso' => true,
        'dpto' => true,
        'barrio' => true,
        'localidad' => true,
        'provincia' => true,
        'codpos' => true,
        'telefono' => true,
        'fax' => true,
        'email' => true,
        'tipo_empresa_id' => true,
        'cant_sucurs' => true,
        'total_emp' => true,
        //'observaciones' => true, 
        'nominas' => true,
        'tramites'=>true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
