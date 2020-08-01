<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RestaurantCuisinesFixture
 */
class RestaurantCuisinesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'restaurant_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cuisine_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'cuisine_key' => ['type' => 'index', 'columns' => ['cuisine_id'], 'length' => []],
            'restaurant_key' => ['type' => 'index', 'columns' => ['restaurant_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['restaurant_id', 'cuisine_id'], 'length' => []],
            'cuisine_key' => ['type' => 'foreign', 'columns' => ['cuisine_id'], 'references' => ['cuisines', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'restaurant_key' => ['type' => 'foreign', 'columns' => ['restaurant_id'], 'references' => ['restaurants', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'restaurant_id' => 1,
                'cuisine_id' => 1,
            ],
        ];
        parent::init();
    }
}
