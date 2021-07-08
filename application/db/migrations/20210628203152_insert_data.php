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
                'nombre' => 'Usuario',
                'apellido' => 'DePrueba1',
                'dni' => 12345678,
                'fnac' => '1997-03-26',
                'celular' => '+5492323111111',
                'mail' => 'usuario1@test.com',
                'pwd' => '$2y$10$.8Cr0.9kTWTEOkjE/59Ghep2LvkosK5MKXkpRkj904f01hcAYWaTe', /* password sin hash: 123456 */
            ],
            [   
                'nombre' => 'Usuario',
                'apellido' => 'DePrueba2',
                'dni' => 12345678,
                'fnac' => '1995-02-02',
                'celular' => '+5492323222222',
                'mail' => 'usuario2@test.com',
                'pwd' => '$2y$10$.8Cr0.9kTWTEOkjE/59Ghep2LvkosK5MKXkpRkj904f01hcAYWaTe', /* password sin hash: 123456 */
            ],
            [
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
                'id_complejo' => 1,
                'numero' => 1
            ],
            [
                'id_complejo' => 1,
                'numero' => 2
            ],
            [
                'id_complejo' => 2,
                'numero' => 1
            ],
            [
                'id_complejo' => 2,
                'numero' => 2
            ],
            [
                'id_complejo' => 2,
                'numero' => 3
            ],
            [
                'id_complejo' => 2,
                'numero' => 4
            ],
            [
                'id_complejo' => 3,
                'numero' => 8
            ],
            [
                'id_complejo' => 3,
                'numero' => 1
            ],
            [
                'id_complejo' => 3,
                'numero' => 2
            ],
            [
                'id_complejo' => 1,
                'numero' => 3
            ],
            [
                'id_complejo' => 4,
                'numero' => 1
            ],
            [
                'id_complejo' => 4,
                'numero' => 2
            ],
        ];

        $generos = [
            [
                'nombre' => 'accion'
            ],
            [
                'nombre' => 'deportes'
            ],
            [
                'nombre' => 'drama'
            ],
            [
                'nombre' => 'suspenso'
            ],
        ];

        $peliculas = [
            [
                // 'imdb_id' => '';
                'titulo' => 'Titanic',
                'sinopsis' => 'Sinopsis de la pelicula',
                'duracion' => 120,
                'id_genero' => 3,
                'fecha_estreno' => '1960-01-27',
                'trailer' => 'url',
                'valoracion' => 8.5,
                'activa' => true
            ],
            [
                // 'imdb_id' => '';
                'titulo' => 'Rocky',
                'sinopsis' => 'Sinopsis de Rocky',
                'duracion' => 105,
                'id_genero' => 2,
                'fecha_estreno' => '2019-03-15',
                'trailer' => 'url al trailer de rocky',
                'valoracion' => 7.5,
                'activa' => false
            ],
            [
                // 'imdb_id' => '';
                'titulo' => 'Pelicula',
                'sinopsis' => 'Sinopsis',
                'duracion' => 100,
                'id_genero' => 3,
                'fecha_estreno' => '2020-05-10',
                'trailer' => 'url',
                'valoracion' => 5.5,
                'activa' => true
            ],
            [
                // 'imdb_id' => '';
                'titulo' => 'Rambo',
                'sinopsis' => 'Todos mueren',
                'duracion' => 120,
                'id_genero' => 1,
                'fecha_estreno' => '1980-07-09',
                'trailer' => 'url',
                'valoracion' => 9.5,
                'activa' => true
            ],
            [
                // 'imdb_id' => '';
                'titulo' => 'Inception',
                'sinopsis' => 'Sinopsis de la pelicula',
                'duracion' => 160,
                'id_genero' => 4,
                'fecha_estreno' => '2000-12-01',
                'trailer' => 'url',
                'valoracion' => 6.3,
                'activa' => false
            ],
        ];

        $tipo_funciones = [
            [
                'descripcion' => 'General',
                'precio' => 300
            ],
            [
                'descripcion' => 'Monster Screen',
                'precio' => 600
            ],
            [
                'descripcion' => '4D',
                'precio' => 800
            ],
        ];
        
        $funciones = [
            [
                'id_sala' => 1,
                'id_pelicula' => 1,
                'id_tipo_funcion' => 1,
                'horario' => '20:00:00'
            ],
            [
                'id_sala' => 5,
                'id_pelicula' => 4,
                'id_tipo_funcion' => 3,
                'horario' => '17:30:00'
            ],

            [
                'id_sala' => 9,
                'id_pelicula' => 4,
                'id_tipo_funcion' => 2,
                'horario' => '23:00:00'
            ],

            [
                'id_sala' => 12,
                'id_pelicula' => 5,
                'id_tipo_funcion' => 3,
                'horario' => '00:15:00'
            ],

            [
                'id_sala' => 7,
                'id_pelicula' => 4,
                'id_tipo_funcion' => 2,
                'horario' => '15:45:00'
            ],

            [
                'id_sala' => 10,
                'id_pelicula' => 3,
                'id_tipo_funcion' => 1,
                'horario' => '19:50:00'
            ],
        ];

        $entradas = [
            [
                'id_usuario' => 3,
                'id_funcion' => 6,
                'ubicacion' => 'A02',
                // 'payment_id' => 
            ],
            [
                'id_usuario' => 2,
                'id_funcion' => 1,
                'ubicacion' => 'J23',
                // 'payment_id' => 
            ],
            [
                'id_usuario' => 1,
                'id_funcion' => 6,
                'ubicacion' => 'H12',
                // 'payment_id' => 
            ],
            [
                'id_usuario' => 2,
                'id_funcion' => 4,
                'ubicacion' => 'A14',
                // 'payment_id' => 
            ],
            [
                'id_usuario' => 3,
                'id_funcion' => 3,
                'ubicacion' => 'B13',
                // 'payment_id' => 
            ],
        ];

        $this->table('usuarios')->insert($usuarios)->save();
        $this->table('complejos')->insert($complejos)->save();
        $this->table('salas')->insert($salas)->save();
        $this->table('generos')->insert($generos)->save();
        $this->table('tipo_funciones')->insert($tipo_funciones)->save();
        $this->table('peliculas')->insert($peliculas)->save();
        $this->table('funciones')->insert($funciones)->save();
        $this->table('entradas')->insert($entradas)->save();

    }
}
