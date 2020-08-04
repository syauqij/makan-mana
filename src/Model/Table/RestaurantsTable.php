<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Restaurants Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BusinessHoursTable&\Cake\ORM\Association\HasMany $BusinessHours
 * @property \App\Model\Table\MenusTable&\Cake\ORM\Association\HasMany $Menus
 * @property \App\Model\Table\ReservationsTable&\Cake\ORM\Association\HasMany $Reservations
 * @property \App\Model\Table\RestaurantCuisinesTable&\Cake\ORM\Association\HasMany $RestaurantCuisines
 * @property \App\Model\Table\RestaurantGalleriesTable&\Cake\ORM\Association\HasMany $RestaurantGalleries
 * @property \App\Model\Table\RestaurantTablesTable&\Cake\ORM\Association\HasMany $RestaurantTables
 *
 * @method \App\Model\Entity\Restaurant newEmptyEntity()
 * @method \App\Model\Entity\Restaurant newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Restaurant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Restaurant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Restaurant findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Restaurant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Restaurant[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Restaurant|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Restaurant saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Restaurant[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Restaurant[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Restaurant[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Restaurant[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
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
}
