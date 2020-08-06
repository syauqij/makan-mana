<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cuisines Model
 *
 * @property \App\Model\Table\RestaurantCuisinesTable&\Cake\ORM\Association\HasMany $RestaurantCuisines
 *
 * @method \App\Model\Entity\Cuisine newEmptyEntity()
 * @method \App\Model\Entity\Cuisine newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Cuisine[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cuisine get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cuisine findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Cuisine patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cuisine[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cuisine|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cuisine saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cuisine[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cuisine[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cuisine[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cuisine[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CuisinesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('cuisines');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Restaurants', [
            'foreignKey' => 'cuisine_id',
            'targetForeignKey' => 'restaurant_id',
            'joinTable' => 'restaurant_cuisines',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }
}
