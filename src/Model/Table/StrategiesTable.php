<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Strategies Model
 *
 * @property \App\Model\Table\ActionsTable|\Cake\ORM\Association\HasMany $Actions
 *
 * @method \App\Model\Entity\Strategy get($primaryKey, $options = [])
 * @method \App\Model\Entity\Strategy newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Strategy[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Strategy|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Strategy patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Strategy[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Strategy findOrCreate($search, callable $callback = null, $options = [])
 */
class StrategiesTable extends Table
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

        $this->setTable('strategies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Actions', [
            'foreignKey' => 'strategy_id'
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
            ->allowEmpty('name');

        $validator
            ->boolean('status')
            ->allowEmpty('status');

        $validator
            ->integer('priority')
            ->allowEmpty('priority');

        $validator
            ->boolean('is_input')
            ->allowEmpty('is_input');

        return $validator;
    }
}
