<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReservationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReservationsTable Test Case
 */
class ReservationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReservationsTable
     */
    protected $Reservations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Reservations',
        'app.Users',
        'app.Restaurants',
        'app.RestaurantTables',
        'app.ReservationLogs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Reservations') ? [] : ['className' => ReservationsTable::class];
        $this->Reservations = $this->getTableLocator()->get('Reservations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Reservations);

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
     * Test findReserved method
     *
     * @return void
     */
    public function testFindReserved(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
