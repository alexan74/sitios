<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Afiliados Model
 *
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 * @property \App\Model\Table\TiposEmpresaTable|\Cake\ORM\Association\BelongsTo $TiposEmpresa
 * @property \App\Model\Table\CategoriasEmpresaTable|\Cake\ORM\Association\BelongsTo $CategoriasEmpresa
 *
 * @method \App\Model\Entity\Afiliado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Afiliado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Afiliado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Afiliado|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Afiliado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Afiliado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Afiliado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Afiliado findOrCreate($search, callable $callback = null, $options = [])
 */
class AfiliadosTable extends Table
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

        $this->setTable('afiliados');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Empresas', [
            'foreignKey' => 'empresa_id'
        ]);
        $this->belongsTo('TiposEmpresa', [
            'foreignKey' => 'tipo_empresa_id'
        ]);
        $this->belongsTo('CategoriasEmpresa', [
            'foreignKey' => 'categoria_id'
        ]);
        $this->belongsTo('Tramites', [
            'foreignKey' => 'tramite_id'
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
            ->nonNegativeInteger('nro_afiliado')
            ->allowEmptyString('nro_afiliado');

        $validator
            ->scalar('nomyape')
            ->maxLength('nomyape', 50)
            ->allowEmptyString('nomyape');

        $validator
            //->dateTime('fecha_nac')
            //->allowEmptyDateTime('fecha_nac');
            ->scalar('fecha_nac')
            ->allowEmptyString('fecha_nac');

        $validator
            ->scalar('cuil')
            ->maxLength('cuil', 15)
            ->allowEmptyString('cuil');

        $validator
            ->scalar('telefono')
            ->maxLength('telefono', 15)
            ->allowEmptyString('telefono');

        $validator
            ->scalar('direccion')
            ->maxLength('direccion', 50)
            ->allowEmptyString('direccion');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('tipo_contratacion')
            ->maxLength('tipo_contratacion', 20)
            ->allowEmptyString('tipo_contratacion');

        $validator
            //->dateTime('fecha_ingreso_afiliado')
            //->allowEmptyDateTime('fecha_ingreso_afiliado');
            ->scalar('fecha_ingreso_afiliado')
            ->allowEmptyString('fecha_ingreso_afiliado');

        $validator
            //->dateTime('fecha_baja_sindicato')
            //->allowEmptyDateTime('fecha_baja_sindicato');
            ->scalar('fecha_baja_sindicato')
            ->allowEmptyString('fecha_baja_sindicato');

        $validator
            ->scalar('telefono_empresa')
            ->maxLength('telefono_empresa', 15)
            ->allowEmptyString('telefono_empresa');

        $validator
            ->scalar('email_empresa')
            ->maxLength('email_empresa', 100)
            ->allowEmptyString('email_empresa');

        $validator
            ->scalar('observaciones')
            ->maxLength('observaciones', 255)
            ->allowEmptyString('observaciones');

        $validator
            //->dateTime('fecha_ingreso_empresa')
            //->allowEmptyDateTime('fecha_ingreso_empresa');
            ->scalar('fecha_ingreso_empresa')
            ->allowEmptyString('fecha_ingreso_empresa');

        $validator
            ->scalar('retiro_carnet')
            ->maxLength('retiro_carnet', 2)
            ->allowEmptyString('retiro_carnet');

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
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));
        $rules->add($rules->existsIn(['tipo_empresa_id'], 'TiposEmpresa'));
        $rules->add($rules->existsIn(['categoria_id'], 'CategoriasEmpresa'));

        return $rules;
    }
}
