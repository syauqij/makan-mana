<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Reservations', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Restaurants', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasOne('UserProfiles', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('SavedRestaurants', [
            'foreignKey' => 'user_id',
        ]);

    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 150)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 150)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('phone_no')
            ->requirePresence('phone_no', 'create')
            ->minLength('phone_no', 10, 'Phone No must be at least 10 digits')
            ->maxLength('phone_no', 12, 'Phone No must be at maximum 12 characters')
            ->notEmptyString('phone_no');

        $validator
            ->scalar('password')
            ->minLength('password', 6, 'Password must be at least 6 characters')
            ->maxLength('password', 20, 'Password must be at maximum 20 characters')
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('token')
            ->maxLength('token', 255)
            ->requirePresence('token', 'create')
            ->notEmptyString('token');

        $validator
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->notEmptyString('role');

            $validator->add('image_file', 'file', [
                'rule' => ['mimeType', ['image/jpeg', 'image/png']],
                'on' => function ($context) {
                    return !empty($context['data']['photo']);
                }
            ]);

        $validator
            ->boolean('active')
            ->notEmptyString('active');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['phone_no']));

        return $rules;
    }

    public function validationPasswords($validator)
    {
        $validator->add('confirm_password', 'no-misspelling', [
            'rule' => ['compareWith', 'password'],
            'message' => 'Passwords does not match',
        ]);
        
        return $validator;
    }    

    public function findByToken($query, $token)
    {   
        $query->where(['Users.token' => $token['token']]);

        return $query;
    }

}
