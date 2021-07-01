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

        $tableEspecialidad = $this->table('especialidades');
        $tableEspecialidad->addColumn('nombre', 'string', [
            'limit' => Constants::getEspNomMax(),
            'null' => false
        ])
            ->addColumn('descripcion', 'string', ['limit' => Constants::getEspDescMax()])
            ->create();

        # Se permite la repeticion de nombres
        $tableEspecialista = $this->table('especialistas');
        $tableEspecialista->addColumn('nombre', 'string', [
            'limit' => Constants::getNomApMax(),
            'null' => false
        ])
            ->addColumn('apellido', 'string', [
                'limit' => Constants::getNomApMax(),
                'null'  => false
            ])
            ->addColumn('matricula', 'string')
            ->addColumn('horaini', 'integer')
            ->addColumn('horafin', 'integer')
            ->addColumn('minutoini', 'integer')
            ->addColumn('minutofin', 'integer')
            ->addColumn('duracion_turno', 'integer')
            ->create();

        $tableDiasQueAtiende = $this->table('dias_que_atiende', ['id' => false, 'primary_key' => ['id', 'id_especialista']]);
        $tableDiasQueAtiende->addColumn('id', 'integer', ['identity' => true])
            ->addColumn('nombre_dia', 'string')
            ->addColumn('id_especialista', 'integer')
            ->addForeignKey('id_especialista', 'especialistas', 'id')
            ->create();

        # PK compuesta => id_especialidad id_especialista
        $tableIntermedia = $this->table('intermedia', ['id' => false, 'primary_key' => ['id_especialista', 'id_especialidad']]);
        $tableIntermedia->addColumn('id_especialidad', 'integer', [
            'limit' => Constants::getEspNomMax(),
            'null' => false
        ])
            ->addColumn('id_especialista', 'integer', [
                'limit' => Constants::getNomApMax(),
                'null' => false
            ])
            # col local   | tbl externa  | col externa
            ->addForeignKey('id_especialidad', 'especialidades', 'id')
            # col local   | tbl externa  | col externa
            ->addForeignKey('id_especialista', 'especialistas', 'id')
            ->create();

        $tableObrasSociales = $this->table('obras_sociales');
        $tableObrasSociales->addColumn('nombre', 'string', [
            'limit' => Constants::getOsNomMax(),
            'null' => false
        ])
            ->create();

        # Restriccion => no puede existir un mail asociado a dos cuentas diferentes
        $tableUsuario = $this->table('usuarios');
        $tableUsuario->addColumn('nombre', 'string', [
            'limit' => Constants::getNomApMax(),
            'null' => false ])
            ->addColumn('apellido', 'string', [
                'limit' => Constants::getNomApMax(),
                'null'  => false ])
            ->addColumn('fnac', 'date', ['null' => false])
            ->addColumn('celular', 'string', [
                'limit' => Constants::getCelMax(),
                'null' => false ])
            ->addColumn('mail', 'string', [
                'limit' => Constants::getMailMax(),
                'null' => false])
            ->addColumn('pwd', 'string', [
                'limit' => Constants::getPwdMax(),
                'null' => false ])
            ->addColumn('id_obra_social', 'integer', ['limit' => Constants::getOsNomMax(), 'null' => true])
            ->addcolumn('rol', 'string')
            # col local   | tbl externa  | col externa
            ->addForeignKey('id_obra_social', 'obras_sociales', 'id')
            ->addIndex(['mail'], [
                'unique' => true,
                'name' => 'idx_ususarios_mail'])
            ->create();

        $tableTurno = $this->table('turnos');
        $tableTurno->addColumn('id_usuario', 'integer')
            ->addColumn('fecha', 'date')
            ->addColumn('hora', 'integer')
            ->addColumn('minuto', 'integer')
            ->addColumn('id_especialista', 'integer')
            ->addColumn('orden_medica', 'string')
            ->addcolumn('nombre_orden_medica', 'string')
            ->addForeignKey('id_usuario', 'usuarios', 'id')
            ->addForeignKey('id_especialista', 'especialistas', 'id')
            ->create();
    }
}
