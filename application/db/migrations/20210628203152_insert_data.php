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

        $usuarios = [
            [
                'id' => 1,
                'nombre' => 'Usuario',
                'apellido' => 'DePrueba1',
                'dni' => 12345678,
                'fnac' => '1997-03-26',
                'celular' => '+5492323111111',
                'mail' => 'usuario1@test.com',
                'pwd' => '$2y$10$.8Cr0.9kTWTEOkjE/59Ghep2LvkosK5MKXkpRkj904f01hcAYWaTe', /* password sin hash: 123456 */
            ],
            [
                'id' => 2,
                'nombre' => 'Usuario',
                'apellido' => 'DePrueba2',
                'dni' => 12345678,
                'fnac' => '1995-02-02',
                'celular' => '+5492323222222',
                'mail' => 'usuario2@test.com',
                'pwd' => '$2y$10$.8Cr0.9kTWTEOkjE/59Ghep2LvkosK5MKXkpRkj904f01hcAYWaTe', /* password sin hash: 123456 */
            ],
            [
                'id' => 3,
                'nombre' => 'Admin',
                'apellido' => 'Root',
                'dni' => 12345678,
                'fnac' => '1995-02-02',
                'celular' => '+5491133333333',
                'mail' => 'soyadmin@test.com',
                'pwd' => '$2y$10$.8Cr0.9kTWTEOkjE/59Ghep2LvkosK5MKXkpRkj904f01hcAYWaTe', /* password sin hash: 123456 */
            ],
        ];

        $complejos = [
            [
                'id' => 1,
                'localidad' => 'Lujan',
                'direccion' => 'Roberto Payro 198',
                'codigo_postal' => 6700
            ],
            [
                'id' => 2,
                'localidad' => 'CABA',
                'direccion' => 'Vicente Lopez 2050',
                'codigo_postal' => 1113
            ],
            [
                'id' => 3,
                'localidad' => 'Pilar',
                'direccion' => 'Autopista Panamericana Km. 50',
                'codigo_postal' => 1629
            ],
            [
                'id' => 4,
                'localidad' => 'Avellaneda',
                'direccion' => 'Au Dr. Ricardo Balbin',
                'codigo_postal' => 1872
            ],
        ];

        $salas = [
            [
                'id' => 1,
                'id_complejo' => 1,
                'numero' => 1
            ],
            [
                'id' => 2,
                'id_complejo' => 1,
                'numero' => 2
            ],
            [
                'id' => 3,
                'id_complejo' => 2,
                'numero' => 1
            ],
            [
                'id' => 4,
                'id_complejo' => 2,
                'numero' => 2
            ],
            [
                'id' => 5,
                'id_complejo' => 2,
                'numero' => 3
            ],
            [
                'id' => 6,
                'id_complejo' => 2,
                'numero' => 4
            ],
            [
                'id' => 7,
                'id_complejo' => 3,
                'numero' => 8
            ],
            [
                'id' => 8,
                'id_complejo' => 3,
                'numero' => 1
            ],
            [
                'id' => 9,
                'id_complejo' => 3,
                'numero' => 2
            ],
            [
                'id' => 10,
                'id_complejo' => 1,
                'numero' => 3
            ],
            [
                'id' => 11,
                'id_complejo' => 4,
                'numero' => 1
            ],
            [
                'id' => 12,
                'id_complejo' => 4,
                'numero' => 2
            ],
        ];

        $generos = [
            [
                'id' => 1,
                'nombre' => 'accion'
            ],
            [
                'id' => 2,
                'nombre' => 'deportes'
            ],
            [
                'id' => 3,
                'nombre' => 'drama'
            ],
            [
                'id' => 4,
                'nombre' => 'suspenso'
            ],
        ];

        // $peliculas = [
        //     [
        //         'id' => 1,
        //         'titulo' => 'Titanic',
        //         'sinopsis' => 'Sinopsis de la pelicula',
        //         'duracion' => 120,
        //         'id_genero' => 3,
        //         'fecha_estreno' => '01/07/1960',
        //         'trailer' => 'https://github.com/ncavasin/cine_paw',
        //         'valoracion' => 8.5,
        //         'activa' => false
        //     ],
        //     [
        //         'id' => 1,
        //         'titulo' => 'Iron Man 3',
        //         'sinopsis' => 'Sinopsis de Iron Man 3',
        //         'duracion' => 160,
        //         'id_genero' => 1,
        //         'fecha_estreno' => '01/07/2015',
        //         'trailer' => 'https://github.com/ncavasin/cine_paw',
        //         'valoracion' => 7.0,
        //         'activa' => false
        //     ],
        //     [
        //         'id' => 2,
        //         'titulo' => 'Rocky I',
        //         'sinopsis' => 'Sinopsis de Rocky I',
        //         'duracion' => 122,
        //         'id_genero' => 2,
        //         'fecha_estreno' => '01/07/2021',
        //         'trailer' => 'https://github.com/ncavasin/cine_paw',
        //         'valoracion' => 8.1,
        //         'activa' => false
        //     ],
        //     [
        //         'id' => 3,
        //         'titulo' => 'Black Widow',
        //         'sinopsis' => 'Sinopsis de la pelicula',
        //         'duracion' => 134,
        //         'id_genero' => 1,
        //         'fecha_estreno' => '01/07/2021',
        //         'trailer' => 'https://github.com/ncavasin/cine_paw',
        //         'activa' => true
        //     ],
        //     [
        //         'id' => 4,
        //         'titulo' => 'Titulo de la pelicula',
        //         'sinopsis' => 'Sinopsis de la pelicula',
        //         'duracion' => 120,
        //         'id_genero' => 'accion',
        //         'fecha_estreno' => '01/07/2021',
        //         'trailer' => 'https://github.com/ncavasin/cine_paw',
        //         'valoracion' => 0.3,
        //         'activa' => true
        //     ]
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

        $this->table('usuarios')->insert($usuarios)->save();
        $this->table('complejos')->insert($complejos)->save();
        $this->table('salas')->insert($salas)->save();
        $this->table('generos')->insert($generos)->save();
        // $this->table('usuarios')->insert($usuarios)->save();
        // $this->table('dias_que_atiende')->insert($diasQueAtiende)->save();
        // $this->table('turnos')->insert($turnos)->save();
    }
}
