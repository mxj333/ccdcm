<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SendsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SendsTable Test Case
 */
class SendsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SendsTable
     */
    public $Sends;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sends',
        'app.actions',
        'app.strategies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Sends') ? [] : ['className' => SendsTable::class];
        $this->Sends = TableRegistry::get('Sends', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sends);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
