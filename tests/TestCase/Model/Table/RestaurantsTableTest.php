<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RestaurantsTable;
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
        'app.Cuisines',
        'app.BusinessHours',
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
        $config = $this->getTableLocator()->exists('Restaurants') ? [] : ['className' => RestaurantsTable::class];
        $this->Restaurants = $this->getTableLocator()->get('Restaurants', $config);
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

    /**
     * Test beforeSave method
     *
     * @return void
     */
    public function testBeforeSave(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findCuisines method
     *
     * @return void
     */
    public function testFindCuisines(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findSearch method
     *
     * @return void
     */
    public function testFindSearch(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findHasRestaurant method
     *
     * @return void
     */
    public function testFindHasRestaurant(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
