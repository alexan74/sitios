<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Empresas Model
 *
 * @property \App\Model\Table\NominasTable|\Cake\ORM\Association\HasMany $Nominas
 *
 * @method \App\Model\Entity\Empresa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Empresa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Empresa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Empresa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Empresa saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Empresa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Empresa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Empresa findOrCreate($search, callable $callback = null, $options = [])
 */
class EmpresasTable extends Table
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

        $this->setTable('empresas');
        $this->setDisplayField('denom_social');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');

        $this->hasMany('Nominas', [
            'foreignKey' => 'empresa_id',
            'dependent'=> true,
            'cascadeCallbacks' => true
        ]);
        
        $this->hasMany('Tramites', [
            'foreignKey' => 'empresa_id',
            'dependent'=> true,
            'cascadeCallbacks' => true
        ]);
        
        $this->belongsTo('TiposEmpresa', [
            'foreignKey' => 'tipo_empresa_id',
            'joinType' => 'LEFT'
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
            ->scalar('cuit')
            ->maxLength('cuit', 15)
            ->requirePresence('cuit', 'create')
            ->allowEmptyString('cuit', false);

        $validator
            ->dateTime('fecha')
            ->allowEmptyDateTime('fecha');

        $validator
            ->scalar('password')
            ->maxLength('password', 50)
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', false);

        $validator
            ->scalar('denom_social')
            ->maxLength('denom_social', 255)
            ->requirePresence('denom_social', 'create')
            ->allowEmptyString('denom_social', false);

        $validator
            ->scalar('calle')
            ->maxLength('calle', 255)
            ->allowEmptyString('calle');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 20)
            ->allowEmptyString('numero');

        $validator
            ->scalar('piso')
            ->maxLength('piso', 20)
            ->allowEmptyString('piso');

        $validator
            ->scalar('dpto')
            ->maxLength('dpto', 20)
            ->allowEmptyString('dpto');

        $validator
            ->scalar('barrio')
            ->maxLength('barrio', 255)
            ->allowEmptyString('barrio');

        $validator
            ->scalar('localidad')
            ->maxLength('localidad', 255)
            ->allowEmptyString('localidad');

        $validator
            ->scalar('provincia')
            ->maxLength('provincia', 255)
            ->allowEmptyString('provincia');

        $validator
            ->scalar('codpos')
            ->maxLength('codpos', 20)
            ->allowEmptyString('codpos');

        $validator
            ->scalar('telefono')
            ->maxLength('telefono', 20)
            ->allowEmptyString('telefono');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 20)
            ->allowEmptyString('fax');

        $validator
            ->email('email')
            ->allowEmptyString('email');
        
       $validator
            ->scalar('tipo_empresa_id')
            ->maxLength('tipo_empresa_id', 10)
            ->requirePresence('tipo_empresa_id', 'create')
            ->allowEmptyString('tipo_empresa_id', false);

        $validator
            ->nonNegativeInteger('cant_sucurs')
            ->allowEmptyString('cant_sucurs');

        $validator
            ->nonNegativeInteger('total_emp')
            ->allowEmptyString('total_emp');
        
       /*$validator
            ->scalar('observaciones')
            ->maxLength('observaciones', 255)
            ->allowEmptyString('observaciones');*/

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
