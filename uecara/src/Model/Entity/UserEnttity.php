<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $nombre
 * @property string $apellido
 * @property bool $ativo
 * @property int $perfil_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Perfil $perfil
 */
class UserEnttity extends Entity
{

    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();
        if (strlen($value) > 0) {
            return $hasher->hash($value);
        }
        return null;
    }
}
