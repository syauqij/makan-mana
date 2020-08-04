<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenuCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenuCategoriesTable Test Case
 */
class MenuCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MenuCategoriesTable
     */
    protected $MenuCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.MenuCategories',
        'app.Menus',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MenuCategories') ? [] : ['className' => MenuCategoriesTable::class];
        $this->MenuCategories = TableRegistry::getTableLocator()->get('MenuCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->MenuCategories);

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
