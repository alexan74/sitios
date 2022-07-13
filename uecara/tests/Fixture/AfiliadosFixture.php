<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AfiliadosFixture
 */
class AfiliadosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'nro_afiliado' => ['type' => 'integer', 'length' => 6, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'nomyape' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fecha_nac' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'cuil' => ['type' => 'string', 'length' => 15, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'telefono' => ['type' => 'string', 'length' => 15, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'direccion' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'empresa_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tipo_empresa_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tipo_contratacion' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fecha_ingreso_afiliado' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'fecha_baja_sindicato' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'telefono_empresa' => ['type' => 'string', 'length' => 15, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'email_empresa' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'observaciones' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fecha_ingreso_empresa' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'categoria_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'retiro_carnet' => ['type' => 'string', 'length' => 2, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'activo' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'tipo_empresa_id' => ['type' => 'index', 'columns' => ['tipo_empresa_id'], 'length' => []],
            'categoria_id' => ['type' => 'index', 'columns' => ['categoria_id'], 'length' => []],
            'empresa_id' => ['type' => 'index', 'columns' => ['empresa_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_afiliados_categorias_empresa' => ['type' => 'foreign', 'columns' => ['categoria_id'], 'references' => ['categorias_empresa', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_afiliados_empresas' => ['type' => 'foreign', 'columns' => ['empresa_id'], 'references' => ['empresas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK_afiliados_tipos_empresa' => ['type' => 'foreign', 'columns' => ['tipo_empresa_id'], 'references' => ['tipos_empresa', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_spanish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'nro_afiliado' => 1,
                'nomyape' => 'Lorem ipsum dolor sit amet',
                'fecha_nac' => '2022-06-28 23:58:06',
                'cuil' => 'Lorem ipsum d',
                'telefono' => 'Lorem ipsum d',
                'direccion' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'empresa_id' => 1,
                'tipo_empresa_id' => 1,
                'tipo_contratacion' => 'Lorem ipsum dolor ',
                'fecha_ingreso_afiliado' => '2022-06-28 23:58:06',
                'fecha_baja_sindicato' => '2022-06-28 23:58:06',
                'telefono_empresa' => 'Lorem ipsum d',
                'email_empresa' => 'Lorem ipsum dolor sit amet',
                'observaciones' => 'Lorem ipsum dolor sit amet',
                'fecha_ingreso_empresa' => '2022-06-28 23:58:06',
                'categoria_id' => 1,
                'retiro_carnet' => 'Lo',
                'activo' => 1
            ],
        ];
        parent::init();
    }
}
