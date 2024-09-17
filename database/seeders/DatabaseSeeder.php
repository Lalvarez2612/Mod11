<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\Cliente;
use App\Models\Repartidore;
use App\Models\Direccione;
use App\Models\ClientesXDireccione;
use App\Models\AsignacionesXOrdene;
use App\Models\MetodosPago;
use App\Models\Menu;
use App\Models\Ordene;
use App\Models\OrdenesHasMenu;
use App\Models\Ruta;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // INSERTAR DATO EN LA TABLA "personas"
        Persona::insert([
            ['cedula' => 28434540, 'nombres' => 'Luis Gabriel', 'apellidos' => 'Álvarez', 'genero' => 'Masculino', 'fecha_nacimiento' => '2001-12-12'],
            ['cedula' => 31046647, 'nombres' => 'Luis Alejandro', 'apellidos' => 'Petit Quintero', 'genero' => 'Masculino', 'fecha_nacimiento' => '2003-03-04'],
            ['cedula' => 30011843, 'nombres' => 'Yosmar', 'apellidos' => 'Pérez', 'genero' => 'Masculino', 'fecha_nacimiento' => '2002-05-20'],
            ['cedula' => 23443678, 'nombres' => 'Madara', 'apellidos' => 'Uchiha', 'genero' => 'Masculino', 'fecha_nacimiento' => '1500-02-15'],
            ['cedula' => 17908775, 'nombres' => 'Satoru', 'apellidos' => 'Goyo', 'genero' => 'Masculino', 'fecha_nacimiento' => '1989-12-07'],
            ['cedula' => 27889321, 'nombres' => 'Yuta', 'apellidos' => 'Okkotsu', 'genero' => 'Masculino', 'fecha_nacimiento' => '2001-03-07'],
        ]);

        // INSERTAR DATO EN LA TABLA "clientes"
        Cliente::insert([
            ['fk_persona' => 1, 'telefono' => '04242797364'],
            ['fk_persona' => 2, 'telefono' => '04143093095'],
            ['fk_persona' => 3, 'telefono' => '04242033409'],
        ]);

        // INSERTAR DATO EN LA TABLA "repartidores"
        Repartidore::insert([
            ['fk_persona' => 4, 'estatus_repartidor' => 'Disponible', 'vehiculo_descripcion' => 'Moto Azúl Bera-Meru'],
            ['fk_persona' => 5, 'estatus_repartidor' => 'Disponible', 'vehiculo_descripcion' => 'Moto Negra Bera-BR200'],
            ['fk_persona' => 6, 'estatus_repartidor' => 'Disponible', 'vehiculo_descripcion' => 'Moto Verde Bera-Carguero 200cc'],
        ]);

        // INSERTAR DATO EN LA TABLA "direcciones"
        Direccione::insert([
            ['estado' => 'Distrito Capital', 'ciudad' => 'Caracas', 'municipio' => 'Libertador', 'parroquia' => 'El Paraíso', 'punto_referencia' => 'Urbanización los Verdes', 'latitud' => '10.4866465', 'longitud' => '-66.9424115'],
            ['estado' => 'Distrito Capital', 'ciudad' => 'Caracas', 'municipio' => 'Libertador', 'parroquia' => 'El Recreo', 'punto_referencia' => 'En Frente de la Torre La Previsora', 'latitud' => '10.5', 'longitud' => '-66.9192749'],
            ['estado' => 'Miranda', 'ciudad' => 'Gran Caracas', 'municipio' => 'Sucre', 'parroquia' => 'Los Dos Caminos', 'punto_referencia' => 'Cerca de la estación de metro Los Dos Caminos', 'latitud' => '10.5066887', 'longitud' => '-66.8519878'],
            ['estado' => 'Distrito Capital','ciudad' => 'Caracas','municipio' => 'Libertador','parroquia' => 'Candelaria','punto_referencia' => 'Al lado de la torre mercantil','latitud' => '10.506081','longitud' => '-66.904309'],
            ['estado' => 'Distrito Capital','ciudad' => 'Caracas','municipio' => 'Libertador','parroquia' => 'Sucre','punto_referencia' => 'En frente de la iglesia Sagrada Familia','latitud' => '10.504692','longitud' => '-66.952679'],
            ['estado' => 'Distrito Capital','ciudad' => 'Caracas','municipio' => 'Libertador','parroquia' => 'Sucre','punto_referencia' => 'Subiendo la cuesta','latitud' =>'10.51401614199949','longitud' => '-66.95131135961391'],
        ]);

        // INSERTAR DATO EN LA TABLA "clientes_x_direcciones"
        ClientesXDireccione::insert([
            ['fk_cliente' => 1, 'fk_direccion' => 1],
            ['fk_cliente' => 2, 'fk_direccion' => 2],
            ['fk_cliente' => 3, 'fk_direccion' => 3],
            ['fk_cliente' => 1, 'fk_direccion' => 4],
            ['fk_cliente' => 2, 'fk_direccion' => 5],
            ['fk_cliente' => 3, 'fk_direccion' => 5],
            ['fk_cliente' => 1, 'fk_direccion' => 6],

        ]);

        // INSERTAR DATO EN LA TABLA "metodos_pagos"
        MetodosPago::insert([
            ['nombre_metodo' => 'Transferencia'],
            ['nombre_metodo' => 'Pago Móvil'],
        ]);

        // INSERTAR DATO EN LA TABLA "menus"
        Menu::insert([
            ['nombre_menu' => 'Hamburguesa Mixta', 'descripcion_menu' => 'Deliciosa hamburguesa de pollo y carne con lechuga y tomate', 'precio_menu' => 10],
            ['nombre_menu' => 'Pizza Margarita', 'descripcion_menu' => 'Pizza con salsa de tomate, queso mozzarella y albahaca', 'precio_menu' => 30],
            ['nombre_menu' => 'Ensalada César', 'descripcion_menu' => 'Ensalada fresca con pollo, lechuga, crutones y aderezo César', 'precio_menu' => 15],
            ['nombre_menu' => 'Tacos de Pollo', 'descripcion_menu' => 'Tacos rellenos de pollo desmenuzado con salsa picante', 'precio_menu' => 10],
            ['nombre_menu' => 'Sopa de Lentejas', 'descripcion_menu' => 'Sopa caliente de lentejas con verduras y especias', 'precio_menu' => 20],
        ]);

        // INSERTAR DATO EN LA TABLA "ordenes"
        Ordene::insert([
            [
                'id_orden' => 1,
                'fk_cliente' => 1,
                'fk_metodoPago' => 1,
                'orden_codigo' => 'O-3342',
                'orden_estatus' => 'Sin Asignar',
                'comentario_adicional' => 'Todas con nextra queso amarrilo y salsa de maíz. Un refresco pepsi de 2 litros.',
                'fechaCreacion_orden' => now(),
            ],
            [
                'id_orden' => 2,
                'fk_cliente' => 2,
                'fk_metodoPago' => 2,
                'orden_codigo' => 'O-1255',
                'orden_estatus' => 'Aisgnada',
                'comentario_adicional' => 'Dos con extra queso, una de peeroni y la otra de champiñones. Un refresco chinoto de 1 litro.',
                'fechaCreacion_orden' => now(),
            ],
            [
                'id_orden' => 3,
                'fk_cliente' => 3,
                'fk_metodoPago' => 2,
                'orden_codigo' => 'O-8964',
                'orden_estatus' => 'Entregada',
                'comentario_adicional' => 'Todos con extra queso y salsa de maiz, agrega 3 refrescos cocacola de 2 litros. Pedido para un evento.',
                'fechaCreacion_orden' => now(),
            ],
            [
                'id_orden' => 4,
                'fk_cliente' => 3,
                'fk_metodoPago' => 1,
                'orden_codigo' => 'O-2367',
                'orden_estatus' => 'Asignada',
                'comentario_adicional' => 'Con extra queso, mayonesa y salsa de tomate. Un refresco colita de 1 litro.',
                'fechaCreacion_orden' => now(),
            ],
        ]);

        // insertar datos en tabla oXm

        OrdenesHasMenu::insert([
            ['id_ordenes_has_menus' => 1,'ordenes_id_orden' => 1,'menus_id_menu' => 1,'cantidad' => 2,],
            ['id_ordenes_has_menus' => 2,'ordenes_id_orden' => 1,'menus_id_menu' => 2,'cantidad' => 1,],
            ['id_ordenes_has_menus' => 3,'ordenes_id_orden' => 2,'menus_id_menu' => 3,'cantidad' => 1,],
            ['id_ordenes_has_menus' => 4,'ordenes_id_orden' => 2,'menus_id_menu' => 4,'cantidad' => 2,],
            ['id_ordenes_has_menus' => 5,'ordenes_id_orden' => 2,'menus_id_menu' => 5,'cantidad' => 3,],
            ['id_ordenes_has_menus' => 6,'ordenes_id_orden' => 3,'menus_id_menu' => 1,'cantidad' => 1,],
            ['id_ordenes_has_menus' => 7,'ordenes_id_orden' => 4,'menus_id_menu' => 2,'cantidad' => 2,],
        ]);

        // INSERTAR DATO EN LA TABLA "rutas"
        Ruta::insert([
            [   // PARA ORDEN CON ESTATUS "Asiganada"
                'id_ruta' => 1,
                'fk_orden' => 2,
                'fk_direccion' => 2,
            ],
            [   // PARA ORDEN CON ESTATUS "Entregada"
                'id_ruta' => 2,
                'fk_orden' => 3,
                'fk_direccion' => 3,
            ],
            [   // PARA ORDEN CON ESTATUS "Asiganada"
                'id_ruta' => 3,
                'fk_orden' => 4,
                'fk_direccion' => 1,
            ],
        ]);

        // INSERTAR DATO EN LA TABLA "asigancioners_x_ordenes"
        AsignacionesXOrdene::insert([
            [    // PARA ORDEN CON ESTATUS "Asiganada"
                'id_asignacionOrden' => 1,
                'fk_repartidor' => 1,
                'fk_orden' => 2,
                'tiempo_inicio' => '10:00:00',
                'tiempo_final' => NULL,
                'fecha_asignacion' => '2024-08-25',
            ],
            [   // PARA ORDEN CON ESTATUS "Entregada"
                'id_asignacionOrden' => 2,
                'fk_repartidor' => 2,
                'fk_orden' => 3,
                'tiempo_inicio' => '09:00:00',
                'tiempo_final' => '11:00:00',
                'fecha_asignacion' => '2024-08-22',
            ],
            [    // PARA ORDEN CON ESTATUS "Asignada"
                'id_asignacionOrden' => 3,
                'fk_repartidor' => 3,
                'fk_orden' => 4,
                'tiempo_inicio' => '13:00:00',
                'tiempo_final' => NULL,
                'fecha_asignacion' => '2024-08-25',
            ],
        ]);
    }
}
