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

        $query->where(['Restaurants.status' => 'approved']);
    
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
                'Restaurants.status' => 'approved',
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
