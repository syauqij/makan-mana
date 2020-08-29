<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\FrozenTime;
use Cake\I18n\Date;
use Cake\I18n\Time;

class ReservationsTable extends Table
{
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
            ->requirePresence('reserved_date', 'create')
            ->notEmptyDateTime('reserved_date');

        $validator
            ->scalar('phone_no')
            ->minLength('phone_no', 12)
            ->maxLength('phone_no', 15)
            ->requirePresence('phone_no', 'create')
            ->notEmptyString('phone_no');

        $validator
            ->scalar('occasion')
            ->maxLength('occasion', 50)
            ->allowEmptyString('occasion');

        $validator
            ->scalar('request')
            ->maxLength('request', 255)
            ->allowEmptyString('request');

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
        $rules->add($rules->isUnique(['reserved_date', 'restaurant_id']));

        return $rules;
    }

    public function findReserved($query, $options) 
    {   
        $id = $options['params']['restaurant_id'];
        $date = $options['params']['reserved_date'];

        $today = new Date($date);
        $timestart = new Date($date);
        $timestart->modify('- 1 day');
        $timeEnd = $today->modify('+1 day');
        
        //dd($date);
        return 
            $query->where([
                'restaurant_id' => $id,
                'reserved_date >=' => $timestart,
                'reserved_date <=' => $timeEnd
            ]
        );
    }        

    public function findUpcoming($query, $options) 
    {   
        $date = $options['params'];

        return 
            $query
                ->limit(3)
                ->where(['reserved_date >=' => $date, 'Reservations.status IN' => ['pending']])
                ->contain(['Restaurants'])
                ->order(['Reservations.reserved_date' => 'ASC']);
    }
  
    public function findBookedToday($query, $options) 
    {   
        $restaurant_id = $options['restaurant_id'];
        
        $timestart = new Date();
        $today = new Date();
        $timeEnd = $today->modify('+1 day');
        
        return 
            $query
                ->where([
                    'restaurant_id' => $restaurant_id, 
                    'created >=' => $timestart,
                    'created <=' => $timeEnd
                ]);
    }        
}
