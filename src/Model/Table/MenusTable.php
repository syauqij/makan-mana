<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Menus Model
 *
 * @property \App\Model\Table\RestaurantsTable&\Cake\ORM\Association\BelongsTo $Restaurants
 * @property \App\Model\Table\MenuCategoriesTable&\Cake\ORM\Association\BelongsTo $MenuCategories
 * @property \App\Model\Table\MenuItemsTable&\Cake\ORM\Association\HasMany $MenuItems
 *
 * @method \App\Model\Entity\Menu newEmptyEntity()
 * @method \App\Model\Entity\Menu newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Menu[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Menu get($primaryKey, $options = [])
 * @method \App\Model\Entity\Menu findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Menu patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Menu[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Menu|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Menu saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MenusTable extends Table
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

        $this->setTable('menus');
        $this->setDisplayField('name');
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
            ->maxLength('description', 150)
            ->allowEmptyString('description');

        $validator
            ->integer('sequence')
            ->requirePresence('sequence', 'create')
            ->notEmptyString('sequence');

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
        $rules->add($rules->existsIn(['restaurant_id'], 'Restaurants'));
        $rules->add($rules->existsIn(['menu_category_id'], 'MenuCategories'));

        return $rules;
    }
}
