<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SavedRestaurantsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SavedRestaurantsTable Test Case
 */
class SavedRestaurantsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SavedRestaurantsTable
     */
    protected $SavedRestaurants;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.SavedRestaurants',
        'app.Users',
        'app.Restaurants',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SavedRestaurants') ? [] : ['className' => SavedRestaurantsTable::class];
        $this->SavedRestaurants = $this->getTableLocator()->get('SavedRestaurants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SavedRestaurants);

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
