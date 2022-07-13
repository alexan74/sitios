<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ClientesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
        ->nonNegativeInteger('id')
        ->allowEmptyString('id', null, 'create');
        
        $validator
        ->scalar('username')
        ->maxLength('username', 50)
        ->requirePresence('username', 'create')
        ->notEmptyString('username');
        
        $validator
        ->scalar('password')
        ->maxLength('password', 255)
        ->requirePresence('password', 'create')
        ->notEmptyString('password');
        
        $validator
        ->scalar('role')
        ->maxLength('role', 20)
        ->allowEmptyString('role');
        
        $validator
        ->integer('cuilt')
        ->requirePresence('cuilt', 'create')
        ->notEmptyString('cuilt');
        
        $validator
        ->scalar('razonsocial')
        ->maxLength('razonsocial', 100)
        ->allowEmptyString('razonsocial');
        
        $validator
        ->scalar('apellido')
        ->maxLength('apellido', 50)
        ->requirePresence('apellido', 'create')
        ->notEmptyString('apellido');
        
        $validator
        ->scalar('nombre')
        ->maxLength('nombre', 50)
        ->requirePresence('nombre', 'create')
        ->notEmptyString('nombre');
        
        $validator
        ->scalar('telefono_trab')
        ->maxLength('telefono_trab', 13)
        ->allowEmptyString('telefono_trab');
        
        $validator
        ->scalar('telefono_personal')
        ->maxLength('telefono_personal', 13)
        ->allowEmptyString('telefono_personal');
        
        $validator
        ->scalar('direccion')
        ->maxLength('direccion', 100)
        ->allowEmptyString('direccion');
        
        $validator
        ->email('email')
        ->allowEmptyString('email');
        
        $validator
        ->integer('habilitado')
        ->notEmptyString('habilitado');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
        //$rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
