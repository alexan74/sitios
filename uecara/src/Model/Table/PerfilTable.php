<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Perfil Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Perfil get($primaryKey, $options = [])
 * @method \App\Model\Entity\Perfil newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Perfil[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Perfil|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Perfil|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Perfil patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Perfil[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Perfil findOrCreate($search, callable $callback = null, $options = [])
 */
class PerfilTable extends Table
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

        $this->setTable('perfil');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Users', [
            'foreignKey' => 'perfil_id'
        ]);
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
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('nombre_perfil')
            ->maxLength('nombre_perfil', 255)
            ->requirePresence('nombre_perfil', 'create')
            ->allowEmptyString('nombre_perfil', false);

        $validator
            ->integer('nivel')
            ->requirePresence('nivel', 'create')
            ->allowEmptyString('nivel', false);

        return $validator;
    }
}
