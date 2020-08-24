<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserProfilesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('user_profiles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('phone_no_2')
            ->maxLength('phone_no_2', 15)
            ->allowEmptyString('phone_no_2');

        $validator
            ->allowEmptyString('gender');

        $validator
            ->scalar('address_line_1')
            ->maxLength('address_line_1', 150)
            ->allowEmptyString('address_line_1');

        $validator
            ->scalar('address_line_2')
            ->maxLength('address_line_2', 150)
            ->allowEmptyString('address_line_2');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 5)
            ->allowEmptyString('postcode');

        $validator
            ->scalar('city')
            ->maxLength('city', 150)
            ->allowEmptyString('city');

        $validator
            ->scalar('state')
            ->maxLength('state', 20)
            ->allowEmptyString('state');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
