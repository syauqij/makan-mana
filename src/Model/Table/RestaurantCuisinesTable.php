<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RestaurantCuisines Model
 *
 * @property \App\Model\Table\RestaurantsTable&\Cake\ORM\Association\BelongsTo $Restaurants
 * @property \App\Model\Table\CuisinesTable&\Cake\ORM\Association\BelongsTo $Cuisines
 *
 * @method \App\Model\Entity\RestaurantCuisine newEmptyEntity()
 * @method \App\Model\Entity\RestaurantCuisine newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantCuisine[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantCuisine get($primaryKey, $options = [])
 * @method \App\Model\Entity\RestaurantCuisine findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RestaurantCuisine patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantCuisine[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantCuisine|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RestaurantCuisine saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RestaurantCuisine[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RestaurantCuisine[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RestaurantCuisine[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RestaurantCuisine[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RestaurantCuisinesTable extends Table
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

        $this->setTable('restaurant_cuisines');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Restaurants', [
            'foreignKey' => 'restaurant_id',
        ]);
        $this->belongsTo('Cuisines', [
            'foreignKey' => 'cuisine_id',
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

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['restaurant_id'], 'Restaurants'), ['errorField' => 'restaurant_id']);
        $rules->add($rules->existsIn(['cuisine_id'], 'Cuisines'), ['errorField' => 'cuisine_id']);

        return $rules;
    }
}
