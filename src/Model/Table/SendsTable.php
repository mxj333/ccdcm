<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sends Model
 *
 * @property \App\Model\Table\ActionsTable|\Cake\ORM\Association\BelongsTo $Actions
 *
 * @method \App\Model\Entity\Send get($primaryKey, $options = [])
 * @method \App\Model\Entity\Send newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Send[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Send|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Send patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Send[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Send findOrCreate($search, callable $callback = null, $options = [])
 */
class SendsTable extends Table
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

        $this->setTable('sends');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Actions', [
            'foreignKey' => 'action_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->integer('type')
            ->allowEmpty('type');

        $validator
            ->allowEmpty('sendto');

        $validator
            ->allowEmpty('subject');

        $validator
            ->allowEmpty('message');

        $validator
            ->boolean('status')
            ->allowEmpty('status');

        $validator
            ->integer('delay')
            ->allowEmpty('delay');

        $validator
            ->integer('repeat')
            ->allowEmpty('repeat');

        $validator
            ->integer('interval')
            ->allowEmpty('interval');

        $validator
            ->integer('executed_num')
            ->allowEmpty('executed_num');

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
        $rules->add($rules->existsIn(['action_id'], 'Actions'));

        return $rules;
    }
}
