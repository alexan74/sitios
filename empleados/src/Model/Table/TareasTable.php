<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TareasTable extends Table
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

        $this->setTable('tareas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        //$this->actAs = array('Containable');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id',
            'joinType' => 'LEFT',
        ]);
        
        $this->belongsTo('Users', [
            'foreignKey' => 'empleado_id',
            'joinType' => 'LEFT',
        ]);
        
        $this->belongsTo('TiposFactura', [
            'foreignKey' => 'tipo_factura_id',
            'joinType' => 'LEFT',
        ]);
        
        $this->belongsTo('TiposPago', [
            'foreignKey' => 'tipo_pago_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('EstadosServicio', [
            'foreignKey' => 'estado_servicio_id',
            'joinType' => 'LEFT',
        ]);
        $this->hasMany('Viaticos', [
            'foreignKey' => 'tarea_id',
            'dependent'=> true,
            'cascadeCallbacks' => true
        ]);
        /*$this->belongsTo('TiposTarea', [
            'foreignKey' => 'tipo_tarea_id',
            'joinType' => 'LEFT',
        ]);*/
        
        /*$this->belongsToMany('Servicios', [
            'joinTable'        => 'servicios_tareas',
            'foreignKey'       => 'tarea_id',
            'targetForeignKey' => 'servicio_id'
            //'propertyName' => 'RbacPerfil',
        ]);*/
        $this->belongsToMany('Servicios', [
            'foreignKey' => 'tarea_id',
            'targetForeignKey' => 'servicio_id',
            'joinTable' => 'servicios_tareas',
        ]);
        
        $this->belongsToMany('TiposTarea', [
            'foreignKey' => 'tarea_id',
            'targetForeignKey' => 'tipo_tarea_id',
            'joinTable' => 'tareas_tipos',
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
            ->nonNegativeInteger('cliente_id')
            ->notEmptyString('cliente_id');
        
        $validator
            ->nonNegativeInteger('empleado_id')
            ->notEmptyString('empleado_id');

        $validator
            ->scalar('fecha')
            //->dateTime('fecha','ymd')
            //->requirePresence('fecha')
            ->notEmptyString('fecha');

        $validator
            ->scalar('costo')
            //->decimal('costo',2)
            //->requirePresence('costo')
            ->notEmptyString('costo');

        $validator
            ->scalar('nro_factura')
            ->maxLength('nro_factura', 20)
            //->requirePresence('nro_factura')
            ->notEmptyString('nro_factura');


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
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'));
        
        $rules->add($rules->existsIn(['empleado_id'], 'Users'));

        return $rules;
    }
}
