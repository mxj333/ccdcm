<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StrategiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StrategiesTable Test Case
 */
class StrategiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StrategiesTable
     */
    public $Strategies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.strategies',
        'app.actions',
        'app.sends'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Strategies') ? [] : ['className' => StrategiesTable::class];
        $this->Strategies = TableRegistry::get('Strategies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Strategies);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
