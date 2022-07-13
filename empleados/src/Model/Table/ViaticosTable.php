<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ViaticosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    
    public $actAs = array('Containable');
    
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('viaticos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        //$this->actAs = array('Containable');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'empleado_id',
            'joinType' => 'LEFT',
        ]);
        
        $this->belongsTo('Tareas', [
            'foreignKey' => 'tarea_id',
            'joinType' => 'LEFT',
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
            ->allowEmptyString('id', null, 'create');
        
        $validator
            ->nonNegativeInteger('empleado_id')
            ->notEmptyString('empleado_id');
        
        $validator
            ->nonNegativeInteger('tarea_id')
            ->allowEmptyString('tarea_id');

        $validator
            ->scalar('fecha')
            //->dateTime('fecha','ymd')
            //->requirePresence('fecha')
            ->notEmptyString('fecha');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 255)
            //->requirePresence('descripcion')
            ->notEmptyString('descripcion');
        
        $validator
            ->scalar('valor')
            //->decimal('costo',2)
            //->requirePresence('valor')
            ->notEmptyString('valor');

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
        $rules->add($rules->existsIn(['tarea_id'], 'Tareas'));
        
        $rules->add($rules->existsIn(['empleado_id'], 'Users'));

        return $rules;
    }
}
