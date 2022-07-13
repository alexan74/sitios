<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Nomina Entity
 *
 * @property int $id
 * @property string|null $apellido
 * @property string|null $nombre
 * @property string|null $categoria
 * @property int|null $cuota_sindical
 * @property int $empresa_id
 *
 * @property \App\Model\Entity\Empresa $empresa
 */
class Nomina extends Entity
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
        'apellido' => true,
        'nombre' => true,
        'categoria' => true,
        'cuota_sindical' => true,
        'empresa_id' => true,
        'empresa' => true
    ];
}
