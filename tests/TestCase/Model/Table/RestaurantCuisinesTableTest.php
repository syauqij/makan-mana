<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RestaurantCuisinesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RestaurantCuisinesTable Test Case
 */
class RestaurantCuisinesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RestaurantCuisinesTable
     */
    protected $RestaurantCuisines;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RestaurantCuisines',
        'app.Restaurants',
        'app.Cuisines',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RestaurantCuisines') ? [] : ['className' => RestaurantCuisinesTable::class];
        $this->RestaurantCuisines = $this->getTableLocator()->get('RestaurantCuisines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RestaurantCuisines);

        parent::tearDown();
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
