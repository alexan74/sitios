<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class TipoEmpresa extends Entity
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
        'tipo' => true,
        'categoria_id' => true,
        'subcategoria_id' => true,
        'activo' => true,
        'categoria_empresa'=>true,
        'subcategoria_empresa'=>true
    ];
}
