<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CuisinesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CuisinesTable Test Case
 */
class CuisinesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CuisinesTable
     */
    protected $Cuisines;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Cuisines',
        'app.RestaurantCuisines',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Cuisines') ? [] : ['className' => CuisinesTable::class];
        $this->Cuisines = TableRegistry::getTableLocator()->get('Cuisines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Cuisines);

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
}
