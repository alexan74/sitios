<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Planillas Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Certificado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Certificado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Certificado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Certificado|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Certificado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Certificado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Certificado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Certificado findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlanillasTable extends Table
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

        $this->setTable('planillas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'cliente_id',
            'joinType' => 'INNER',
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
            ->scalar('descripcion')
            ->maxLength('descripcion', 250)
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion');

        $validator
            ->scalar('periodo')
            ->maxLength('periodo', 100)
            ->requirePresence('periodo', 'create')
            ->notEmptyString('periodo');

        $validator
            ->scalar('link')
            ->maxLength('link', 500)
            ->requirePresence('link', 'create')
            ->notEmptyString('link');

        /*$validator
            ->nonNegativeInteger('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmptyString('created_by');
*/
        $validator
            ->nonNegativeInteger('modified_by')
            ->allowEmptyString('modified_by');

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
        $rules->add($rules->existsIn(['cliente_id'], 'Users'));

        return $rules;
    }
}
