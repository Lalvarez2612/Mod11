<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Ordene;

class ordenesController
{
    // VISTA INDEX

    public function welcome()
    {
        return view("welcome");
    }

    // CONSULTA GENERAL PARA LA VISTA RESUMEN ORDENES

    public function index()
    {
        $ordenes = Ordene::select("id_orden","orden_codigo","nombre_menu","descripcion_menu","orden_estatus",
                                  "comentario_adicional","orden_cantidad","fechaCreacion_orden",
                                  "cedula","telefono","nombre_metodo")
        ->selectRaw("CONCAT(nombres,' ',apellidos) AS nombre_apellido")
        ->selectRaw("CONCAT(estado,', ',ciudad,', ',municipio,', ',parroquia,', ',punto_referencia) AS direccion")
        ->join("menus","menus.id_menu","=","ordenes.fk_menu")
        ->join("metodos_pagos","metodos_pagos.id_metodoPago","=","ordenes.fk_metodoPago")
        ->join("clientes","clientes.id_cliente","=","ordenes.fk_cliente")
        ->join("personas","personas.id_persona","=","clientes.fk_persona")
        ->join("clientes_x_direcciones","clientes_x_direcciones.fk_cliente","=","clientes.id_cliente")
        ->join("direcciones","clientes_x_direcciones.fk_direccion","=","direcciones.id_direccion")
        ->orderBy("fechaCreacion_orden","desc")
        ->get();

        $bolean = TRUE;

        return view("ordenesResumen", compact("ordenes","bolean"));
    }

    // ENCONTRAR UNA ORDEN POR CODIGO

    public function show(Request $request)
    {
        $request->validate([
            "buscarCodigo" => "required|regex:/^O-\d{4}$/"
        ]);

        $codigo = $request->post("buscarCodigo");

        $ordenes = Ordene::select("id_orden","orden_codigo","nombre_menu","descripcion_menu","orden_estatus",
                                  "comentario_adicional","orden_cantidad","fechaCreacion_orden",
                                  "cedula","telefono","nombre_metodo")
        ->selectRaw("CONCAT(nombres,' ',apellidos) AS nombre_apellido")
        ->selectRaw("CONCAT(estado,', ',ciudad,', ',municipio,', ',parroquia,', ',punto_referencia) AS direccion")
        ->join("menus","menus.id_menu","=","ordenes.fk_menu")
        ->join("metodos_pagos","metodos_pagos.id_metodoPago","=","ordenes.fk_metodoPago")
        ->join("clientes","clientes.id_cliente","=","ordenes.fk_cliente")
        ->join("personas","personas.id_persona","=","clientes.fk_persona")
        ->join("clientes_x_direcciones","clientes_x_direcciones.fk_cliente","=","clientes.id_cliente")
        ->join("direcciones","clientes_x_direcciones.fk_direccion","=","direcciones.id_direccion")
        ->where("orden_codigo","=",$codigo)
        ->first();

        $bolean = FALSE;

        if($ordenes != NULL){
            return view("ordenesResumen", compact("ordenes","bolean"));
        }
        else{
            return redirect()->route('ordenes.index')->withErrors([
                'buscarCodigo' => '¡Esta Orden no existe en el Sistema!'
            ]);
        }
        
    }

    // VISTA CON EL FORMULARIO PARA CREAR ORDEN

    public function create()
    {
        return view("crearOrden");
    }

    // CREAR NUEVA ORDEN EN EL SISTEMA

    public function store(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string|regex:/^[0-9]{2}[0-9]{3}[0-9]{3}$/',
            'platillo' => 'required|in:Hamburgesa Mixta,Pizza Margarita,Ensalada César,Tacos de Pollo,Sopa de Lentejas',
            'orden_cantidad' => 'required|numeric|min:1',
            'comentario_adicional' => 'required|string',
            'metodo_pago' => 'required|in:Transferencia,Pago Móvil',
        ]);

        // HAYAR EL ID DEL CLIENTE
        $cedula = $request->post("cedula");
        $idClient = Cliente::select("id_cliente")
        ->join("personas","personas.id_persona","=","clientes.fk_persona")
        ->where("cedula","=",$cedula)
        ->first();

        if ($idClient != NULL) {

            // INVOCAR MODELO PARA UN NUEVO REGISTRO
            $orden = new Ordene;

            // CAPTURAR LOS DATOS DEL FORM PARA CREAR UNA NUEVA ORDEN
            $orden->fk_cliente = $idClient->id_cliente;

            // CAPTURAR LA fk_menu DEL FORMULARIO

            if($request->post("platillo") == "Hamburgesa Mixta"){
                $idMenu = 1;
                $orden->fk_menu = $idMenu;
            }
            if($request->post("platillo") == "Pizza Margarita"){
                $idMenu = 2;
                $orden->fk_menu = $idMenu;
            }
            if($request->post("platillo") == "Ensalada César"){
                $idMenu = 3;
                $orden->fk_menu = $idMenu;
            }
            if($request->post("platillo") == "Tacos de Pollo"){
                $idMenu = 4;
                $orden->fk_menu = $idMenu;
            }
            if($request->post("platillo") == "Sopa de Lentejas"){
                $idMenu = 5;
                $orden->fk_menu = $idMenu;
            }

            // CAPTURAR EL METODO DE PAGO

            if($request->post("metodo_pago") == "Transferencia"){
                $idMetodoPago = 1;
                $orden->fk_metodoPago = $idMetodoPago;
            }

            if($request->post("metodo_pago") == "Pago Móvil"){
                $idMetodoPago = 2;
                $orden->fk_metodoPago = $idMetodoPago;
            }

            // GENERAR CODIGO AUTOMATICO DE LA ORDEN

            $numAleatorio = rand(1000,9999);
            $codigoOrden = "O-".$numAleatorio;
            $orden->orden_codigo = $codigoOrden;

            $orden->orden_cantidad = $request->post("orden_cantidad");
            $orden->comentario_adicional = $request->post("comentario_adicional");
            $orden->orden_estatus = "Sin Asignar";
            $orden->fechaCreacion_orden = NOW();

            $orden->save(); // GENERAMOS EL INSERT EN LA TABLA "ordenes"

            if($orden->save()){
                return redirect()->route('ordenes.index')->with("success", "¡Orden Creada con Éxito!");
            }
        } 
        else {
            return redirect()->route('ordenes.create')->withErrors([
                'cedula' => '¡Esta cédula no es de un Cliente o no Existe en el Sistema!'
            ]);
        }

    }

    // VISTA CON FORMULARIO PARA EDITAR LA ORDEN

    public function edit($id_orden)
    {
        $updateOrden = Ordene::select("id_orden","cedula","orden_codigo","precio_menu",
                                      "nombre_menu","orden_cantidad","orden_estatus",
                                      "comentario_adicional","nombre_metodo")
        ->selectRaw("precio_menu * orden_cantidad AS total_pago")
        ->join("clientes","clientes.id_cliente","=","ordenes.fk_cliente")
        ->join("personas","personas.id_persona","=","clientes.fk_persona")
        ->join("menus","menus.id_menu","=","ordenes.fk_menu")
        ->join("metodos_pagos","metodos_pagos.id_metodoPago","=","ordenes.fk_metodoPago")
        ->where("id_orden","=",$id_orden)
        ->first();

        return view("updateOrden", compact("updateOrden"));

    }

    // LOGICA PARA ACTUALIZAR LA TABLA "ordenes"

    public function update(Request $request, $id_orden)
    {
        $request->validate([
            'cedula' => 'required|string|regex:/^[0-9]{2}[0-9]{3}[0-9]{3}$/',
            'platillo' => 'required|in:Hamburgesa Mixta,Pizza Margarita,Ensalada César,Tacos de Pollo,Sopa de Lentejas',
            'orden_cantidad' => 'required|numeric|min:1',
            'comentario_adicional' => 'required|string',
            'metodo_pago' => 'required|in:Transferencia,Pago Móvil',
        ]);

        // HAYAR EL ID DEL CLIENTE

        $cedula = $request->post("cedula");
        $idClient = Cliente::select("id_cliente")
        ->join("personas","personas.id_persona","=","clientes.fk_persona")
        ->where("cedula","=",$cedula)
        ->first();

        if ($idClient != NULL) {

            // ENCONTRAR EL OBJETOR Y SUSTITUIR LOS VALORES
            $ordenUpdate = Ordene::find($id_orden);

            // CAPTURAR LOS DATOS DEL FORM PARA CREAR UNA NUEVA ORDEN
            $ordenUpdate->fk_cliente = $idClient->id_cliente;

            // CAPTURAR LA fk_menu DEL FORMULARIO

            if($request->post("platillo") == "Hamburgesa Mixta"){
                $idMenu = 1;
                $ordenUpdate->fk_menu = $idMenu;
            }
            if($request->post("platillo") == "Pizza Margarita"){
                $idMenu = 2;
                $ordenUpdate->fk_menu = $idMenu;
            }
            if($request->post("platillo") == "Ensalada César"){
                $idMenu = 3;
                $ordenUpdate->fk_menu = $idMenu;
            }
            if($request->post("platillo") == "Tacos de Pollo"){
                $idMenu = 4;
                $ordenUpdate->fk_menu = $idMenu;
            }
            if($request->post("platillo") == "Sopa de Lentejas"){
                $idMenu = 5;
                $ordenUpdate->fk_menu = $idMenu;
            }

            // CAPTURAR EL METODO DE PAGO

            if($request->post("metodo_pago") == "Transferencia"){
                $idMetodoPago = 1;
                $ordenUpdate->fk_metodoPago = $idMetodoPago;
            }

            if($request->post("metodo_pago") == "Pago Móvil"){
                $idMetodoPago = 2;
                $ordenUpdate->fk_metodoPago = $idMetodoPago;
            }

            $ordenUpdate->orden_cantidad = $request->post("orden_cantidad");
            $ordenUpdate->comentario_adicional = $request->post("comentario_adicional");

            $ordenUpdate->save(); // GENERAMOS EL UPDATE EN LA TABLA "ordenes"

            if($ordenUpdate->save()){
                return redirect()->route('ordenes.index')->with("success", "¡Orden Actualizada con Éxito!");
            }
        } 
        else {
            return redirect()->back()->withErrors([
                'cedula' => '¡Esta cédula no es de un Cliente o no Existe en el Sistema!'
            ]);
        }

    }

    // PARA LA VISTA DE DELETE ORDEN

    public function delete($id_orden)
    {
        $ordenDelete = Ordene::select("id_orden","orden_codigo","nombre_menu","descripcion_menu","orden_estatus",
                                  "comentario_adicional","orden_cantidad","fechaCreacion_orden",
                                  "cedula","telefono","nombre_metodo")
        ->selectRaw("CONCAT(nombres,' ',apellidos) AS nombre_apellido")
        ->selectRaw("CONCAT(estado,', ',ciudad,', ',municipio,', ',parroquia,', ',punto_referencia) AS direccion")
        ->join("menus","menus.id_menu","=","ordenes.fk_menu")
        ->join("metodos_pagos","metodos_pagos.id_metodoPago","=","ordenes.fk_metodoPago")
        ->join("clientes","clientes.id_cliente","=","ordenes.fk_cliente")
        ->join("personas","personas.id_persona","=","clientes.fk_persona")
        ->join("clientes_x_direcciones","clientes_x_direcciones.fk_cliente","=","clientes.id_cliente")
        ->join("direcciones","clientes_x_direcciones.fk_direccion","=","direcciones.id_direccion")
        ->where("id_orden","=",$id_orden)
        ->first();

        return view("deleteOrden",compact("ordenDelete"));

    }

    // LOGICA PARA REALIZAR EL DELETE DE LA TABLA "ordenes"

    public function destroy($id_orden)
    {
        $ordenDestroy = Ordene::find($id_orden);
        $ordenDestroy->delete();

        // SI TODO SALE BEIN VOLVER A LA VISTA RESUMEN ORDENES
        return redirect()->route('ordenes.index')->with("success", "¡Orden Eliminada con Éxito!");

    }
}
