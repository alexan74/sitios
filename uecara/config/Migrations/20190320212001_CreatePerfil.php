<?php
use Migrations\AbstractMigration;

class CreatePerfil extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('perfil');

        $table->addColumn('nome_perfil', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);

        $table->addColumn('nivel', 'integer', [
            'default' => null,
            'null' => false,
        ]);

        $table->create();

        $table->insert(["id" => 1, "nome_perfil" => 'admin', "nivel" => 1000])->save();
        $table->insert(["id" => 2, "nome_perfil" => 'gestor', "nivel" => 999])->save();
        $table->insert(["id" => 3, "nome_perfil" => 'funcionario', "nivel" => 998])->save();
        
    }
}