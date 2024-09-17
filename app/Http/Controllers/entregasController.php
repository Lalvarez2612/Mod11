<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Ordene;

class entregasController
{
    public function index()
    {
        $ordenes = Ordene::select("id_orden","orden_codigo","orden_estatus",
                "comentario_adicional","fechaCreacion_orden","cedula","telefono","nombre_metodo")
        ->selectRaw("CONCAT(nombres,' ',apellidos) AS nombre_apellido")
        ->selectRaw("CONCAT(estado,', ',ciudad,', ',municipio,', ',parroquia,', ',punto_referencia) AS direccion")
        ->selectRaw("SEC_TO_TIME(ABS(TIME_TO_SEC(TIMEDIFF(tiempo_inicio, tiempo_final)))) as tiempo_total")
        ->join("metodos_pagos","metodos_pagos.id_metodoPago","=","ordenes.fk_metodoPago")
        ->join("clientes","clientes.id_cliente","=","ordenes.fk_cliente")
        ->join("personas","personas.id_persona","=","clientes.fk_persona")
        ->join("clientes_x_direcciones","clientes_x_direcciones.fk_cliente","=","clientes.id_cliente")
        ->join("direcciones","clientes_x_direcciones.fk_direccion","=","direcciones.id_direccion")
        ->join("asignaciones_x_ordenes","asignaciones_x_ordenes.fk_orden","=","ordenes.id_orden")
        ->where("orden_estatus","Sin Asignar")
        ->orWhere("orden_estatus","Entregada")
        ->groupBy('id_orden')
        ->orderBy("fechaCreacion_orden","desc")
        ->get();

        $platillos=Ordene::select('id_orden','nombre_menu','descripcion_menu','precio_menu','cantidad')
        ->join('ordenes_has_menus','id_orden','=','ordenes_id_orden')
        ->join('menus','id_menu','=','menus_id_menu')
        ->groupBy('id_ordenes_has_menus')
        ->get();

        $bolean = TRUE;
        return view("ordenesEntregadas",compact("ordenes",'platillos',"bolean"));
    }

    // BUSCAR UNA SOLA ORDEN ENTREGADA POR CODIGO
    public function show(Request $request)
    {
        $request->validate([
            "buscarCodigo" => "required|regex:/^O-\d{4}$/"
        ]);

        $bolean = FALSE;
        $codigo = $request->post("buscarCodigo");
        $ordenes = Ordene::select("id_orden","orden_codigo","orden_estatus",
                                  "fechaCreacion_orden",
                                  "cedula","telefono","nombre_metodo",'comentario_adicional')
        ->selectRaw("CONCAT(nombres,' ',apellidos) AS nombre_apellido")
        ->selectRaw("CONCAT(estado,', ',ciudad,', ',municipio,', ',parroquia,', ',punto_referencia) AS direccion")
        ->join("metodos_pagos","metodos_pagos.id_metodoPago","=","ordenes.fk_metodoPago")
        ->join("clientes","clientes.id_cliente","=","ordenes.fk_cliente")
        ->join("personas","personas.id_persona","=","clientes.fk_persona")
        ->join("clientes_x_direcciones","clientes_x_direcciones.fk_cliente","=","clientes.id_cliente")
        ->join("direcciones","clientes_x_direcciones.fk_direccion","=","direcciones.id_direccion")
        ->where("orden_codigo","=",$codigo)
        ->where("orden_estatus","Entregada")
        ->groupBy('orden_codigo')
        ->get();

        $platillos= Ordene::select('id_orden','nombre_menu','descripcion_menu','precio_menu','cantidad')
        ->join('ordenes_has_menus','id_orden','=','ordenes_id_orden')
        ->join('menus','id_menu','=','menus_id_menu')
        ->where('orden_codigo','=',$codigo)
        ->groupBy('id_ordenes_has_menus')
        ->get();

        if($ordenes->isNotEmpty()){
            return view("ordenesEntregadas", compact("ordenes",'platillos',"bolean"));
        }
        else{
            return redirect()->route('entregas.index')->withErrors([
                'buscarCodigo' => '¡Esta Orden aún no ha sido Entregada!'
            ]);
        }
    }
}
