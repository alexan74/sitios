<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AfiliadosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AfiliadosTable Test Case
 */
class AfiliadosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AfiliadosTable
     */
    public $Afiliados;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Afiliados',
        'app.Empresas',
        'app.TiposEmpresa',
        'app.CategoriasEmpresa'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Afiliados') ? [] : ['className' => AfiliadosTable::class];
        $this->Afiliados = TableRegistry::getTableLocator()->get('Afiliados', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Afiliados);

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
