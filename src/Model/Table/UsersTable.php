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
            ->minLength('phone_no', 10)
            ->maxLength('phone_no', 12)
            ->notEmptyString('phone_no');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
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
            'message' => 'Passwords are not equal',
        ]);
        
        return $validator;
    }    

    public function findByToken($query, $token)
    {   
        $query->where(['Users.token' => $token['token']]);

        return $query;
    }

}
