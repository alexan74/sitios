<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Tramite extends Entity
{
    protected $_accessible = [
        'tipo_tramite' => true,
        'empresa_id' => true,
        'observaciones'=> true,
        'empresa' => true,
        'archivos' => true
    ];
}
