<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\Event\EventInterface;
use Cake\I18n\FrozenTime;

class RestaurantsTable extends Table
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

        $this->setTable('restaurants');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsToMany('Cuisines', [
            'joinTable' => 'restaurant_cuisines',
            'dependent' => true
        ]);

        $this->hasMany('BusinessHours', [
            'foreignKey' => 'restaurant_id',
        ]);
        $this->hasMany('Menus', [
            'foreignKey' => 'restaurant_id',
        ]);
        $this->hasMany('Reservations', [
            'foreignKey' => 'restaurant_id',
        ]);
        $this->hasMany('RestaurantCuisines', [
            'foreignKey' => 'restaurant_id',
        ]);
        $this->hasMany('RestaurantGalleries', [
            'foreignKey' => 'restaurant_id',
        ]);
        $this->hasMany('RestaurantTables', [
            'foreignKey' => 'restaurant_id',
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
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('address_line_1')
            ->maxLength('address_line_1', 150)
            ->requirePresence('address_line_1', 'create')
            ->notEmptyString('address_line_1');

        $validator
            ->scalar('address_line_2')
            ->maxLength('address_line_2', 150)
            ->requirePresence('address_line_2', 'create')
            ->notEmptyString('address_line_2');

        $validator
            ->scalar('city')
            ->maxLength('city', 150)
            ->requirePresence('city', 'create')
            ->notEmptyString('city');

        $validator
            ->scalar('state')
            ->maxLength('state', 150)
            ->requirePresence('state', 'create')
            ->notEmptyString('state');

        $validator
            ->scalar('contact_no')
            ->maxLength('contact_no', 12)
            ->requirePresence('contact_no', 'create')
            ->notEmptyString('contact_no');

        $validator
            ->scalar('website')
            ->maxLength('website', 150)
            ->allowEmptyString('website');

        $validator
            ->numeric('price_range')
            ->requirePresence('price_range', 'create')
            ->notEmptyString('price_range');

        $validator
            ->scalar('payment_options')
            ->maxLength('payment_options', 100)
            ->requirePresence('payment_options', 'create')
            ->notEmptyString('payment_options');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function beforeSave(EventInterface $event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->slug) {

            $sluggedName = Text::slug($entity->name);
            // trim slug to maximum length defined in schema
            $trimSlug = substr($sluggedName, 0, 191);
            $total = $this->find()->where(['name' => $entity->name])->count();
            if ($total > 0) {
                $entity->slug = $trimSlug ."(". $total . ")";
            } else {
                $entity->slug = $trimSlug;
            }
        }
    }    

    public function findCuisines($query, $options)
    {   
        $key = $options['term'];

         if (empty($key)) {
            $query->leftJoinWith('Cuisines')
                ->where(['Cuisines.name IS' => null]);
        } else {
            $query->innerJoinWith('Cuisines')
                ->where(['Cuisines.name IN' => $key]);
        }
    
        return $query->group(['Restaurants.id']);
    }    

    public function findSearch($query, $options)
    {   
        $term = $options['params']['term'];
        $date = $options['params']['date'];
        $time = $options['params']['time'];

        $selectedDate = new FrozenTime($date . $time);

        $query->innerJoinWith('Cuisines')
            ->where([
                'OR' => [
                    ['Restaurants.name LIKE' => '%' . $term . '%'],
                    ['Restaurants.city LIKE' => '%' . $term . '%'],
                    ['Restaurants.state LIKE' => '%' . $term . '%'],
                    ['Cuisines.name LIKE' => '%' . $term . '%']
                ],
            ]);

        return $query->group(['Restaurants.id']);
    }
}
