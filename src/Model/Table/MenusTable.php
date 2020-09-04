<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MenusTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('menus');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Restaurants', [
            'foreignKey' => 'restaurant_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('MenuCategories', [
            'foreignKey' => 'menu_category_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('MenuItems', [
            'foreignKey' => 'menu_id',
            'saveStrategy' => 'replace',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 150)
            ->allowEmptyString('description');

        $validator
            ->integer('sequence')
            ->requirePresence('sequence', 'create')
            ->notEmptyString('sequence');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['restaurant_id'], 'Restaurants'));
        $rules->add($rules->existsIn(['menu_category_id'], 'MenuCategories'));

        return $rules;
    }

    public function findRestaurantMenu($query, $options) 
    {   
        $id = $options['params']['restaurant_id'];

        return $query->where([
            'restaurant_id' => $id,
        ]);
    }
}
