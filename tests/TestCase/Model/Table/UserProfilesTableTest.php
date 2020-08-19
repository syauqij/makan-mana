<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserProfilesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserProfilesTable Test Case
 */
class UserProfilesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserProfilesTable
     */
    protected $UserProfiles;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.UserProfiles',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UserProfiles') ? [] : ['className' => UserProfilesTable::class];
        $this->UserProfiles = $this->getTableLocator()->get('UserProfiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserProfiles);

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
