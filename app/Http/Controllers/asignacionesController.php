<?php

namespace App\Http\Controllers;

use App\Models\AsignacionesXOrdene;
use Illuminate\Http\Request;
use App\Models\Ordene;
use App\Models\Repartidore;

class asignacionesController
{
    public function index()
    {
        // CONSULTA PARA MOSTRAR LAS ORDENES ASIGNADAS JUNTO A LA RUTA DEL REPARTIDOR
        $rutaRepartidor = Repartidore::select("orden_codigo","cedula","vehiculo_descripcion",
                                              "tiempo_inicio","tiempo_final","fecha_asignacion")
        ->selectRaw("CONCAT(nombres,' ',apellidos) AS nombre_apellido",)
        ->join("asignaciones_x_ordenes","asignaciones_x_ordenes.fk_repartidor","=","repartidores.id_repartidor")
        ->selectRaw("CONCAT(estado,', ',ciudad,', ',municipio,', ',parroquia,', ',punto_referencia) AS direccion")
        ->join("personas","personas.id_persona","=","repartidores.fk_persona")
        ->join("ordenes","ordenes.id_orden","=","asignaciones_x_ordenes.fk_orden")
        ->join("clientes","clientes.id_cliente","=","ordenes.fk_cliente")
        ->join("clientes_x_direcciones","clientes_x_direcciones.fk_cliente","=","clientes.id_cliente")
        ->join("direcciones","clientes_x_direcciones.fk_direccion","=","direcciones.id_direccion")
        ->orderBy("fecha_asignacion","desc")
        ->get();

        $bolean = TRUE;
        return view("rutasAsignadas",compact("rutaRepartidor","bolean"));
    }

    public function create($id_orden)
    {
        // PARA CAPTURAR EL ID DE LA ORDEN 
    
        $ordenAsignar = Ordene::select("id_orden","orden_codigo","nombre_menu")
        ->join("menus","menus.id_menu","=","ordenes.fk_menu")
        ->where("id_orden",$id_orden)
        ->first();

        // CONSULTAR LOS REPARTIDORES DISPONIBLES

        $repartidores = Repartidore::select("id_repartidor","cedula","genero",
                                            "estatus_repartidor","vehiculo_descripcion")
        ->selectRaw("CONCAT(nombres,' ',apellidos) AS nombre_apellido",)
        ->join("personas","personas.id_persona","=","repartidores.fk_persona")
        ->where("estatus_repartidor","Disponible")
        ->get();

        //return $repartidores;
        return view("asignarOrden", compact("ordenAsignar","repartidores"));
    }

    public function store($id_orden,$id_repartidor)
    {
        // INVOCAR MODELO PARA NUEVO REGISTRO

        $asignRepart = new AsignacionesXOrdene;
        $asignRepart->fk_repartidor = $id_repartidor;
        $asignRepart->fk_orden = $id_orden;
        $asignRepart->tiempo_inicio = now()->setTimezone('America/Caracas')->format('H:i:s');
        $asignRepart->tiempo_final = NULL;
        $asignRepart->fecha_asignacion = now()->setTimezone('America/Caracas')->format('Y-m-d');;
        $asignRepart->save();

        if($asignRepart->save()){
            // INVOCAR AL MODELO DE ORDENES PARA ACTUALIZAR EL CAMPOR "orden_estatus" A "Asignado"
            $updateOrden = Ordene::find($id_orden);
            $updateOrden->orden_estatus = "Asignada";
            $updateOrden->save();

            return redirect()->route('rutas.index')->with("success", "¡Orden Asignada con Éxito!");
        }
    }

    public function show(Request $request)
    {
        $request->validate([
            "tiempo_final" => "required|regex:/^O-\d{4}$/"
        ]);

        $codigo = $request->post("tiempo_final");

        // CAPTURAMOS EL ID DE LA ORDEN Y DE LA TABLA PUENTE "asignaciones_x_ordenes" MEDIANTE EL CODIGO

        $IdsOrdens = Ordene::select("id_orden","id_asignacionOrden")
        ->join("asignaciones_x_ordenes","asignaciones_x_ordenes.fk_orden","=","ordenes.id_orden")
        ->where("orden_codigo",$codigo)
        ->first();

        if($IdsOrdens !== NULL){
            
            // VALIDAR QUE NO FINALIZEN MAS DE UNA VE UNA RUTA Y ORDEN
            $rutaFin = Ordene::select("orden_estatus")
            ->where("id_orden",$IdsOrdens->id_orden)
            ->where("orden_estatus","Asignada")
            ->first();

            if($rutaFin !== NULL){
                // REALIZAMOS EL UPDATE EN TABLA "asiganciones_x_ordenes"
                $ordenAsig = AsignacionesXOrdene::find($IdsOrdens->id_asignacionOrden);
                $ordenAsig->tiempo_final = now()->setTimezone('America/Caracas')->format('H:i:s');
                $ordenAsig->save();
    
                if($ordenAsig->save()){
                    // REALIZAMOS EL UPDATE EN TABLA "ordenes"
                    $ordenLista = Ordene::find($IdsOrdens->id_orden);
                    $ordenLista->orden_estatus = "Entregada";
                    $ordenLista->save();
                    
                    return redirect()->route('rutas.index')->with("success", "¡Orden Finalizada con Éxito, Búscala en la Sección de Entregas !");
                }
            }
            else{
                return redirect()->route('rutas.index')->withErrors([
                    'tiempo_final' => '¡Está Orden ya ha sida Finalizada!'
                ]);
            }
        }
        else{
            return redirect()->route('rutas.index')->withErrors([
                'tiempo_final' => '¡Está Orden no existe en el Sistema!'
            ]);
        }
    }

    // LOGICA PARA BUSCAR LA RUTA POR CODIGO DE LA ORDEN O FECHA DE ASIGNACION
    public function findCodigo(Request $request)
    {
        if($request->post("buscarCodigo") || $request->post("fecha_asignacion")){

            $codigOrde = $request->post("buscarCodigo");
            $fechaAsignacion = $request->post("fecha_asignacion");

            if (preg_match('/^O-\d{4}$/', $codigOrde) || preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $fechaAsignacion )){

                $rutaRepartidor = Repartidore::select("orden_codigo","cedula","vehiculo_descripcion",
                                "tiempo_inicio","tiempo_final","fecha_asignacion")
                ->selectRaw("CONCAT(nombres,' ',apellidos) AS nombre_apellido",)
                ->join("asignaciones_x_ordenes","asignaciones_x_ordenes.fk_repartidor","=","repartidores.id_repartidor")
                ->selectRaw("CONCAT(estado,', ',ciudad,', ',municipio,', ',parroquia,', ',punto_referencia) AS direccion")
                ->join("personas","personas.id_persona","=","repartidores.fk_persona")
                ->join("ordenes","ordenes.id_orden","=","asignaciones_x_ordenes.fk_orden")
                ->join("clientes","clientes.id_cliente","=","ordenes.fk_cliente")
                ->join("clientes_x_direcciones","clientes_x_direcciones.fk_cliente","=","clientes.id_cliente")
                ->join("direcciones","clientes_x_direcciones.fk_direccion","=","direcciones.id_direccion")
                ->where("orden_codigo",$codigOrde)
                ->orwhere("fecha_asignacion",$fechaAsignacion)
                ->get();

                if($rutaRepartidor->isNotEmpty()){
                    $bolean = FALSE;
                    return view("rutasAsignadas",compact("rutaRepartidor","bolean"));
                }else{
                    return redirect()->route('rutas.index')->withErrors([
                        'buscarCodigo' => '¡Está Orden no ha sido Asignada o Creada en el Sistema!'
                    ]);
                }
            }
            else{
                return redirect()->route('rutas.index')->withErrors([
                    'buscarCodigo' => '¡El Código o La Fecha no conicide con el Formato Requerido!'
                ]);
            }
        }
        else{
            return redirect()->route('rutas.index')->withErrors([
                'buscarCodigo' => '¡Debe llenar alguno de los Campos para realizar la Busqueda!'
            ]);
        }
    }
}
