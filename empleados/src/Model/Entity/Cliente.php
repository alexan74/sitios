<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * Cliente Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $role
 * @property int $cuilt
 * @property string|null $razonsocial
 * @property string $apellido
 * @property string $nombre
 * @property string|null $telefono_trab
 * @property string|null $telefono_personal
 * @property string|null $direccion
 * @property string|null $email
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $habilitado
 */
class Cliente extends Entity
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
        'username' => true,
        'password' => true,
        'role' => true,
        'cuilt' => true,
        'razonsocial' => true,
        'apellido' => true,
        'nombre' => true,
        'telefono_trab' => true,
        'telefono_personal' => true,
        'direccion' => true,
        'email' => true,
        'created' => true,
        'modified' => true,
        'habilitado' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }
    
}
