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
            ->scalar('description')
            ->allowEmptyString('description');

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
            ->allowEmptyString('operation_hours');

        $validator
            ->scalar('price_range')
            ->maxLength('price_range', 50)
            ->allowEmptyString('price_range');

        $validator
            ->scalar('payment_options')
            ->maxLength('payment_options', 100)
            ->allowEmptyString('payment_options');

        $validator
            ->notEmptyFile('image_file')
            ->uploadedFile('image_file', [
                'types' => ['image/png'], // only PNG image files
                'minSize' => 1024, // Min 1 KB
                'maxSize' => 1024 * 1024 // Max 1 MB
            ])
        /*     ->add('image_file', 'minImageSize', [
                'rule' => ['imageSize', [
                    // Min 10x10 pixel
                    'width' => [Validation::COMPARE_GREATER_OR_EQUAL, 10],
                    'height' => [Validation::COMPARE_GREATER_OR_EQUAL, 10],
                ]]
            ])
            ->add('image_file', 'maxImageSize', [
                'rule' => ['imageSize', [
                    // Max 100x100 pixel
                    'width' => [Validation::COMPARE_LESS_OR_EQUAL, 100],
                    'height' => [Validation::COMPARE_LESS_OR_EQUAL, 100],
                ]]
            ]) */
            ->add('image_file', 'filename', [
                'rule' => function (UploadedFileInterface $file) {
                    // filename must not be a path
                    $filename = $file->getClientFilename();
                    if (strcmp(basename($filename), $filename) === 0) {
                        return true;
                    }
        
                    return false;
                }
            ])
            ->add('image_file', 'extension', [
                'rule' => ['extension', ['png', 'jpeg', 'jpg']] // .png file extension only
            ]);

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

        $query->where(['Restaurants.status' => ['featured', 'active']]);
    
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
