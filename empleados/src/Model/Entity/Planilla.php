<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Planilla Entity
 *
 * @property int $id
 * @property int $cliente_id
 * @property string $descripcion
 * @property string $periodo
 * @property string $link
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int|null $modified_by
 */
class Planilla extends Entity
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
        'cliente_id' => true,
        'descripcion' => true,
        'periodo' => true,
        'link' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
    ];
}
