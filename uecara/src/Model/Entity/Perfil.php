<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Perfil Entity
 *
 * @property int $id
 * @property string $nombre_perfil
 * @property int $nivel
 *
 * @property \App\Model\Entity\User[] $users
 */
class Perfil extends Entity
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
        'nombre_perfil' => true,
        'nivel' => true,
        'users' => true
    ];
}
