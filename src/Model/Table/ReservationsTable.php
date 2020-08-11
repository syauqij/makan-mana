<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ReservationsTable extends Table
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

        $this->setTable('reservations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Restaurants', [
            'foreignKey' => 'restaurant_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('RestaurantTables', [
            'foreignKey' => 'restaurant_table_id',
        ]);
        $this->hasMany('ReservationLogs', [
            'foreignKey' => 'reservation_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->dateTime('reserved_date')
            ->allowEmptyDateTime('reserved_date');

        $validator
            ->integer('total_guests')
            ->requirePresence('total_guests', 'create')
            ->notEmptyString('total_guests');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['restaurant_id'], 'Restaurants'), ['errorField' => 'restaurant_id']);
        $rules->add($rules->existsIn(['restaurant_table_id'], 'RestaurantTables'), ['errorField' => 'restaurant_table_id']);

        return $rules;
    }

    public function findReserved($query, $options) 
    {   
        $id = $options['params']['id'];
        $date = $options['params']['date'];
        return 
            $query->where([
                    'restaurant_id' => $id, 
                    'reserved_date >=' => $date]
        );
    }    
}
