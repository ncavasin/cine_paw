<?php

declare(strict_types=1);

use Paw\core\database\Constants;
use Phinx\Migration\AbstractMigration;


final class FirstMigrations extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {

        $tableComplejos = $this->table('complejos');
        $tableComplejos->addColumn('nombre', 'string', [
                'limit' => Constants::getNomApMax(),
                'null' => false])
            ->addColumn('dirección', 'string', ['limit' => Constants::getDirMax()])
            ->create();


        $tableSalas = $this->table('salas');
        $tableSalas->addColumn('id_complejo', 'integer')
            ->addColumn('numero', 'integer', ['null' => false])
            ->addForeignKey('id_complejo', 'complejos', 'id')
            ->create();

            
        $tablePeliculas = $this->table('peliculas');
        $tablePeliculas->addColumn('titulo', 'string', [
                'limit' => Constants::getTituloMax(), 
                'null' => false])
            ->addColumn('sinopsis', 'string', [
                'limit' => Constants::getSinopsisMax(),
                'null' => true])
            ->addColumn('duracion', 'integer', ['null' => false])
            ->addColumn('genero', 'string', [
                'limit' => Constants::getNomApMax(),
                'null' => false])
            ->addColumn('fecha_estreno', 'date', ['null' => false])
            ->addColumn('trailer', 'string', [
                'limit' => Constants::getLinkMax(),
                'null' => true])
            ->addColumn('valoracion', 'integer', ['null' => true])
            ->addColumn('activa', 'boolean', ['null' => false])
            ->create();


        # Restriccion => no puede existir un mail asociado a dos cuentas diferentes
        $tableUsuarios = $this->table('usuarios');
        $tableUsuarios->addColumn('nombre', 'string', [
                'limit' => Constants::getNomApMax(),
                'null' => false ])
            ->addColumn('apellido', 'string', [
                'limit' => Constants::getNomApMax(),
                'null'  => false ])
            ->addColumn('fnac', 'date', ['null' => false])
            ->addColumn('dni', 'integer', ['null' => false])
            ->addColumn('celular', 'string', [
                'limit' => Constants::getCelMax(),
                'null' => false ])
            ->addColumn('mail', 'string', [
                'limit' => Constants::getMailMax(),
                'null' => false])
            ->addColumn('pwd', 'string', [
                'limit' => Constants::getPwdMax(),
                'null' => false ])
            // ->addcolumn('rol', 'string'),
            ->addIndex(['mail'], [
                'unique' => true,
                'name' => 'idx_usuarios_mail'])
            ->create();


        $tableTipoFunciones = $this->table('tipo_funciones');
        $tableTipoFunciones->addColumn('descripcion', 'string', [
                'limit' => Constants::getTipoDescMax(),
                'null' => false])
            ->addColumn('precio', 'float', ['null' => false])
            ->create();


        $tableFunciones = $this->table('funciones');
        $tableFunciones->addColumn('id_sala', 'integer', ['null' => false])
            ->addColumn('id_pelicula', 'integer', ['null' => false])
            ->addColumn('id_tipo_funcion', 'integer', ['null' => false])
            ->addColumn('horario', 'time', ['null' => false])
            ->addForeignKey('id_sala', 'salas', 'id')
            ->addForeignKey('id_pelicula', 'peliculas', 'id')
            ->addForeignKey('id_tipo_funcion', 'funciones', 'id')
            ->create();


        $tableEntradas = $this->table('entradas');
        $tableEntradas->addColumn('id_usuario', 'integer', ['null' => false])
            ->addColumn('id_funcion', 'integer', ['null' => false])
            ->addColumn('ubicacion', 'string', [
                'limit' => Constants::getUbiMax(),
                'null' => false])
            ->addForeignKey('id_usuario', 'usuarios', 'id')
            ->addForeignKey('id_funcion', 'funciones', 'id')
            ->create();
    }
}
