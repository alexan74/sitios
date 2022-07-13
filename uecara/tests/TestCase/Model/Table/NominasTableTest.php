<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NominasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NominasTable Test Case
 */
class NominasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\NominasTable
     */
    public $Nominas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Nominas',
        'app.Empresas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Nominas') ? [] : ['className' => NominasTable::class];
        $this->Nominas = TableRegistry::getTableLocator()->get('Nominas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Nominas);

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
