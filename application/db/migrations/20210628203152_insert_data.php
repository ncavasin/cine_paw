<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class InsertData extends AbstractMigration
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
    public function up(): void
    {
        // $especialistas = [
        //     [
        //         'id' => 1,
        //         'nombre' => 'Especialista',
        //         'apellido' => 'DePrueba1',
        //         'matricula' => 'matricula1',
        //         'horaini' => 9,
        //         'horafin' => 12,
        //         'minutoini' => 0,
        //         'minutofin' => 30,
        //         'duracion_turno' => 30,
        //     ],
        //     [
        //         'id' => 2,
        //         'nombre' => 'Especialista',
        //         'apellido' => 'DePrueba2',
        //         'matricula' => 'matricula2',
        //         'horaini' => 9,
        //         'horafin' => 12,
        //         'minutoini' => 0,
        //         'minutofin' => 40,
        //         'duracion_turno' => 20,
        //     ],
        //     [
        //         'id' => 3,
        //         'nombre' => 'Especialista',
        //         'apellido' => 'DePrueba3',
        //         'matricula' => 'matricula3',
        //         'horaini' => 10,
        //         'horafin' => 15,
        //         'minutoini' => 30,
        //         'minutofin' => 30,
        //         'duracion_turno' => 15,
        //     ],
        //     [
        //         'id' => 4,
        //         'nombre' => 'Especialista',
        //         'apellido' => 'DePrueba4',
        //         'matricula' => 'matricula4',
        //         'horaini' => 7,
        //         'horafin' => 12,
        //         'minutoini' => 10,
        //         'minutofin' => 10,
        //         'duracion_turno' => 25,
        //     ],
        // ];
        // $diasQueAtiende = [
        //     [
        //         'id' => 1,
        //         'id_especialista' => 1,
        //         'nombre_dia' => 'Lunes'
        //     ],
        //     [
        //         'id' => 2,
        //         'id_especialista' => 1,
        //         'nombre_dia' => 'Martes'
        //     ],
        //     [
        //         'id' => 3,
        //         'id_especialista' => 1,
        //         'nombre_dia' => 'Jueves'
        //     ],
        //     [
        //         'id' => 1,
        //         'id_especialista' => 2,
        //         'nombre_dia' => 'Lunes'
        //     ],
        //     [
        //         'id' => 2,
        //         'id_especialista' => 2,
        //         'nombre_dia' => 'Miercoles'
        //     ],
        //     [
        //         'id' => 3,
        //         'id_especialista' => 2,
        //         'nombre_dia' => 'Viernes'
        //     ],
        //     [
        //         'id' => 1,
        //         'id_especialista' => 3,
        //         'nombre_dia' => 'Martes'
        //     ],
        //     [
        //         'id' => 2,
        //         'id_especialista' => 3,
        //         'nombre_dia' => 'Miercoles'
        //     ],
        //     [
        //         'id' => 3,
        //         'id_especialista' => 3,
        //         'nombre_dia' => 'Viernes'
        //     ],
        //     [
        //         'id' => 1,
        //         'id_especialista' => 4,
        //         'nombre_dia' => 'Lunes'
        //     ],
        //     [
        //         'id' => 2,
        //         'id_especialista' => 4,
        //         'nombre_dia' => 'Jueves'
        //     ],
        // ];
        // $especialidades = [
        //     [
        //         'id' => 1,
        //         'nombre' => 'Alergia',
        //         'descripcion' => 'descripcion de la especialidad'
        //     ],
        //     [
        //         'id' => 2,
        //         'nombre' => 'Cirugía plastica',
        //         'descripcion' => 'descripcion de la especialidad'
        //     ],
        //     [
        //         'id' => 3,
        //         'nombre' => 'Diabetología',
        //         'descripcion' => 'descripcion de la especialidad'
        //     ],
        //     [
        //         'id' => 4,
        //         'nombre' => 'Neonatología',
        //         'descripcion' => 'descripcion de la especialidad'
        //     ],
        //     [
        //         'id' => 5,
        //         'nombre' => 'Oncología',
        //         'descripcion' => 'descripcion de la especialidad'
        //     ],
        //     [
        //         'id' => 6,
        //         'nombre' => 'Pediratría',
        //         'descripcion' => 'descripcion de la especialidad'
        //     ],
        //     [
        //         'id' => 7,
        //         'nombre' => 'Terapia intensiva',
        //         'descripcion' => 'descripcion de la especialidad'
        //     ],
        // ];
        // $intermedia = [
        //     [
        //         'id_especialidad' => 1,
        //         'id_especialista' => 1,
        //     ],
        //     [
        //         'id_especialidad' => 3,
        //         'id_especialista' => 1,
        //     ],
        //     [
        //         'id_especialidad' => 4,
        //         'id_especialista' => 1,
        //     ],
        //     [
        //         'id_especialidad' => 1,
        //         'id_especialista' => 2,
        //     ],
        //     [
        //         'id_especialidad' => 3,
        //         'id_especialista' => 2,
        //     ],
        //     [
        //         'id_especialidad' => 6,
        //         'id_especialista' => 2,
        //     ],
        //     [
        //         'id_especialidad' => 7,
        //         'id_especialista' => 2,
        //     ],
        //     [
        //         'id_especialidad' => 2,
        //         'id_especialista' => 3,
        //     ],
        //     [
        //         'id_especialidad' => 3,
        //         'id_especialista' => 3,
        //     ],
        //     [
        //         'id_especialidad' => 5,
        //         'id_especialista' => 3,
        //     ],
        //     [
        //         'id_especialidad' => 1,
        //         'id_especialista' => 4,
        //     ],
        //     [
        //         'id_especialidad' => 3,
        //         'id_especialista' => 4,
        //     ],
        //     [
        //         'id_especialidad' => 5,
        //         'id_especialista' => 4,
        //     ],
        //     [
        //         'id_especialidad' => 6,
        //         'id_especialista' => 4,
        //     ],
        // ];
        // $obras_sociales = [['id' => 1, 'nombre' => 'Medical Test']];
        // $usuarios = [
        //     [
        //         'id' => 1,
        //         'nombre' => 'Usuario',
        //         'apellido' => 'DePrueba1',
        //         'fnac' => '1995-01-01',
        //         'celular' => '+5492323111111',
        //         'mail' => 'usuario1@test.com',
        //         'pwd' => '$2y$10$.8Cr0.9kTWTEOkjE/59Ghep2LvkosK5MKXkpRkj904f01hcAYWaTe',
        //         'id_obra_social' => 1,
        //         'rol' => 'user'
        //     ],
        //     [
        //         'id' => 2,
        //         'nombre' => 'Usuario',
        //         'apellido' => 'DePrueba2',
        //         'fnac' => '1995-02-02',
        //         'celular' => '+5492323222222',
        //         'mail' => 'usuario2@test.com',
        //         'pwd' => '$2y$10$.8Cr0.9kTWTEOkjE/59Ghep2LvkosK5MKXkpRkj904f01hcAYWaTe', /* password sin hash: 123456 */
        //         'id_obra_social' => 1,
        //         'rol' => 'user'
        //     ],
        //     [
        //         'id' => 3,
        //         'nombre' => 'Especialista',
        //         'apellido' => 'DePrueba1',
        //         'fnac' => '1995-02-02',
        //         'celular' => '+5491133333333',
        //         'mail' => 'especialista1@test.com',
        //         'pwd' => '$2y$10$.8Cr0.9kTWTEOkjE/59Ghep2LvkosK5MKXkpRkj904f01hcAYWaTe',
        //         'id_obra_social' => 1,
        //         'rol' => 'medic'
        //     ],
        // ];
        // $turnos = [
        //     [
        //         'id' => 1,
        //         'id_especialista' => 1,
        //         'id_usuario' => 1,
        //         'orden_medica' => '',
        //         'nombre_orden_medica' => '',
        //         'hora' => 11,
        //         'minuto' => 30,
        //         'fecha' => '2021-10-10',
        //     ],
        //     [
        //         'id' => 2,
        //         'id_especialista' => 1,
        //         'id_usuario' => 2,
        //         'orden_medica' => '',
        //         'nombre_orden_medica' => '',
        //         'hora' => 10,
        //         'minuto' => 0,
        //         'fecha' => '2021-10-10',
        //     ],
        //     [
        //         'id' => 3,
        //         'id_especialista' => 1,
        //         'id_usuario' => 2,
        //         'orden_medica' => '',
        //         'nombre_orden_medica' => '',
        //         'hora' => 9,
        //         'minuto' => 30,
        //         'fecha' => '2021-10-10',
        //     ],
        //     [
        //         'id' => 4,
        //         'id_especialista' => 1,
        //         'id_usuario' => 2,
        //         'orden_medica' => '',
        //         'nombre_orden_medica' => '',
        //         'hora' => 10,
        //         'minuto' => 30,
        //         'fecha' => '2021-10-10',
        //     ],
        // ];

        // $this->table('especialistas')->insert($especialistas)->save();
        // $this->table('especialidades')->insert($especialidades)->save();
        // $this->table('intermedia')->insert($intermedia)->save();
        // $this->table('obras_sociales')->insert($obras_sociales)->save();
        // $this->table('usuarios')->insert($usuarios)->save();
        // $this->table('dias_que_atiende')->insert($diasQueAtiende)->save();
        // $this->table('turnos')->insert($turnos)->save();
    }
}
