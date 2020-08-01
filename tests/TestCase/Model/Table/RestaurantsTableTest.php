<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RestaurantsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RestaurantsTable Test Case
 */
class RestaurantsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RestaurantsTable
     */
    protected $Restaurants;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Restaurants',
        'app.Users',
        'app.Menus',
        'app.Reservations',
        'app.RestaurantCuisines',
        'app.RestaurantGalleries',
        'app.RestaurantTables',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Restaurants') ? [] : ['className' => RestaurantsTable::class];
        $this->Restaurants = TableRegistry::getTableLocator()->get('Restaurants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Restaurants);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
