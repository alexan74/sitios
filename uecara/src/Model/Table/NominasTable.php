<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Nominas Model
 *
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\Nomina get($primaryKey, $options = [])
 * @method \App\Model\Entity\Nomina newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Nomina[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Nomina|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Nomina saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Nomina patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Nomina[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Nomina findOrCreate($search, callable $callback = null, $options = [])
 */
class NominasTable extends Table
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

        $this->setTable('nominas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Empresas', [
            'foreignKey' => 'empresa_id',
            'joinType' => 'INNER'
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('apellido')
            ->maxLength('apellido', 50)
            ->allowEmptyString('apellido');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 50)
            ->allowEmptyString('nombre');

        $validator
            ->scalar('categoria')
            ->maxLength('categoria', 50)
            ->allowEmptyString('categoria');

        $validator
            ->allowEmptyString('cuota_sindical');

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
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));

        return $rules;
    }
}
