<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CertificadosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CertificadosTable Test Case
 */
class CertificadosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CertificadosTable
     */
    public $Certificados;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Certificados',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Certificados') ? [] : ['className' => CertificadosTable::class];
        $this->Certificados = TableRegistry::getTableLocator()->get('Certificados', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Certificados);

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
