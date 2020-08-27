<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RestaurantsTable extends Table
{

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
        $this->hasMany('Menus', [
            'foreignKey' => 'restaurant_id',
        ]);
        $this->hasMany('Reservations', [
            'foreignKey' => 'restaurant_id',
        ]);
        $this->hasMany('RestaurantCuisines', [
            'foreignKey' => 'restaurant_id',
            'saveStrategy' => "replace"
        ]);
        $this->hasMany('RestaurantGalleries', [
            'foreignKey' => 'restaurant_id',
        ]);
        $this->hasMany('SavedRestaurants', [
            'foreignKey' => 'restaurant_id',
        ]);
    }

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
            ->scalar('slug')
            ->maxLength('slug', 191)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

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
            ->scalar('postcode')
            ->maxLength('postcode', 5)
            ->requirePresence('postcode', 'create')
            ->notEmptyString('postcode');

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
            ->scalar('operation_hours')
            ->maxLength('operation_hours', 255)
            ->requirePresence('operation_hours', 'create')
            ->notEmptyString('operation_hours');

        $validator
            ->scalar('price_range')
            ->maxLength('price_range', 50)
            ->requirePresence('price_range', 'create')
            ->notEmptyString('price_range');

        $validator
            ->scalar('payment_options')
            ->maxLength('payment_options', 100)
            ->requirePresence('payment_options', 'create')
            ->notEmptyString('payment_options');

        $validator
            ->scalar('image_file')
            ->maxLength('image_file', 150)
            ->requirePresence('image_file', 'create')
            ->notEmptyFile('image_file');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->notEmptyString('status');

        return $validator;
    }


    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
    
    public function beforeSave(EventInterface $event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->slug) {

            $sluggedName = Text::slug($entity->name);
            // trim slug to maximum length defined in schema
            $trimSlug = substr($sluggedName, 0, 191);
            $total = $this->find()->where(['Restaurants.name' => $entity->name])->count();
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

        $query->where(['Restaurants.status IN' => ['featured', 'active']]);
    
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
                'Restaurants.status IN' => ['featured', 'active'],
                'OR' => [
                    ['Restaurants.name LIKE' => '%' . $term . '%'],
                    ['Restaurants.city LIKE' => '%' . $term . '%'],
                    ['Restaurants.state LIKE' => '%' . $term . '%'],
                    ['Cuisines.name LIKE' => '%' . $term . '%']
                ],
            ]);

        return $query->group(['Restaurants.id']);
    }

    public function findHasRestaurant($query, $options) {
        $user_id = $options['user_id'];

        return $query->where(['Restaurants.user_id' => $user_id]);
    }
}
