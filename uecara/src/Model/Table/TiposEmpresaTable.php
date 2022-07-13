<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class TiposEmpresaTable extends Table
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

        $this->setTable('tipos_empresa');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        $this->belongsTo('CategoriasEmpresa', [
            'foreignKey' => 'categoria_id',
            'joinType' => 'INNER'
        ]);
        
        $this->belongsTo('SubCategoriasEmpresa', [
            'foreignKey' => 'subcategoria_id',
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
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('tipo')
            ->maxLength('tipo', 255)
            ->requirePresence('tipo', 'create')
            ->allowEmptyString('tipo', false);
        
        $validator
            ->scalar('categoria_id')
            ->maxLength('categoria_id', 255)
            ->requirePresence('categoria_id', 'create')
            ->allowEmptyString('categoria_id', false);
        
        $validator
            ->scalar('subcategoria_id')
            ->maxLength('subcategoria_id', 255)
            ->requirePresence('subcategoria_id', 'create')
            ->allowEmptyString('subcategoria_id', false);

        $validator
            ->integer('activo')
            ->requirePresence('activo', 'create')
            ->allowEmptyString('activo', false);

        return $validator;
    }
}
