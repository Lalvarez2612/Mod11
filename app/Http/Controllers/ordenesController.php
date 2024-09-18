<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Menu;
use App\Models\Ordene;
use App\Models\OrdenesHasMenu;

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
        $bolean = TRUE;
        $tiempoEntrega ="";
        $ordenes = Ordene::select("id_orden","orden_codigo","orden_estatus","fechaCreacion_orden",
                                  "cedula","telefono","nombre_metodo",'comentario_adicional')
        ->selectRaw("CONCAT(nombres,' ',apellidos) AS nombre_apellido")
        ->selectRaw("CONCAT(estado,', ',ciudad,', ',municipio,', ',parroquia,', ',punto_referencia) AS direccion")
        ->join("metodos_pagos","metodos_pagos.id_metodoPago","=","ordenes.fk_metodoPago")
        ->join("clientes","clientes.id_cliente","=","ordenes.fk_cliente")
        ->join("personas","personas.id_persona","=","clientes.fk_persona")
        ->join("clientes_x_direcciones","clientes_x_direcciones.fk_cliente","=","clientes.id_cliente")
        ->join("direcciones","clientes_x_direcciones.fk_direccion","=","direcciones.id_direccion")
        ->where("orden_estatus","Sin Asignar")
        ->orWhere("orden_estatus","Asignada")
        ->groupBy('orden_codigo')
        ->orderBy("fechaCreacion_orden","desc")
        ->get();

        $platillos=Ordene::select('id_orden','nombre_menu','descripcion_menu','precio_menu','cantidad')
        ->join('ordenes_has_menus','id_orden','=','ordenes_id_orden')
        ->join('menus','id_menu','=','menus_id_menu')
        ->groupBy('id_ordenes_has_menus')
        ->get();

        return view("ordenesResumen", compact("ordenes","tiempoEntrega",'platillos',"bolean"));
    }

    // ENCONTRAR UNA ORDEN POR CODIGO

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
        ->groupBy('orden_codigo')
        ->get();

        $platillos= Ordene::select('id_orden','nombre_menu','descripcion_menu','precio_menu','cantidad')
        ->join('ordenes_has_menus','id_orden','=','ordenes_id_orden')
        ->join('menus','id_menu','=','menus_id_menu')
        ->where('orden_codigo','=',$codigo)
        ->groupBy('id_ordenes_has_menus')
        ->get();


        // CONSULTAR EL TIEMPO TOTAL EN CASO DE QUE LA ORDE HAYA SIDO ENTREGADA
        $tiempoEntrega = Ordene::selectRaw("SEC_TO_TIME(ABS(TIME_TO_SEC(TIMEDIFF(tiempo_inicio, tiempo_final)))) as tiempo_total")
        ->join("asignaciones_x_ordenes","asignaciones_x_ordenes.fk_orden","=","ordenes.id_orden")
        ->where("orden_codigo","=",$codigo)
        ->first();

        if($ordenes != NULL){
            return view("ordenesResumen", compact("ordenes","tiempoEntrega",'platillos',"bolean"));
        }
        else{
            return redirect()->route('ordenes.index')->withErrors([
                'buscarCodigo' => '¡Esta Orden no existe o ya ha sido Finalizada en el Sistema!'
            ]);
        }
    }

    // VISTA CON EL FORMULARIO PARA CREAR ORDEN
    public function create()
    {

        $platillos = Menu::select('id_menu','nombre_menu','precio_menu')->get();


        return view("crearOrden", compact('platillos'));
    }


    // SOLICITUD AJAX
    public function calculo($id){

        $menu=Menu::find($id);

        return response()->json($menu);
    }

    // CREAR NUEVA ORDEN EN EL SISTEMA
    public function store(Request $request)
    {
        $request->validate([
            'cedula' => 'required|numeric|regex:/^[0-9]{2}[0-9]{3}[0-9]{3}$/',
            'platillo' => 'required|array',
            'platillo.*' => 'required|exists:menus,id_menu',
            'orden_cantidad'=> 'required|array',
            'orden_cantidad.*' => 'required|numeric|min:1',
            'comentario_adicional' => 'required|string|max:500',
            'metodo_pago' => 'required|in:Transferencia,Pago Móvil',
        ]);

        // HAYAR EL ID DEL CLIENTE
        $cedula = $request->post("cedula");
        $platillos = $request->post('platillo');
        $cantidad=$request->orden_cantidad;
        $idClient = Cliente::select("id_cliente")
        ->join("personas","personas.id_persona","=","clientes.fk_persona")
        ->where("cedula","=",$cedula)
        ->first();

        if ($idClient != NULL) {

            // INVOCAR MODELO PARA UN NUEVO REGISTRO
            $orden = new Ordene;

            // CAPTURAR LOS DATOS DEL FORM PARA CREAR UNA NUEVA ORDEN
            $orden->fk_cliente = $idClient->id_cliente;

            
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

            $orden->comentario_adicional = $request->post("comentario_adicional");
            $orden->orden_estatus = "Sin Asignar";
            $orden->fechaCreacion_orden = NOW()->setTimezone('America/Caracas')->format('H:i:s');

            $saved=$orden->save(); // GENERAMOS EL INSERT EN LA TABLA "ordenes"

            if($saved){
                $aux=0;
                foreach ($platillos as $platillo) {
                    $oXm=new OrdenesHasMenu();
                    $oXm->ordenes_id_orden=$orden->id_orden;
                    $oXm->menus_id_menu=$platillo;
                    $oXm->cantidad=$cantidad[$aux];
                    $saved= $oXm->save();
                    if($saved){
                        $aux++;
                    }
                }
                
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
        $updateOrden = Ordene::select("id_orden","cedula","orden_codigo","orden_estatus",
                                      "nombre_metodo")
        ->join("clientes","clientes.id_cliente","=","ordenes.fk_cliente")
        ->join("personas","personas.id_persona","=","clientes.fk_persona")
        ->join("metodos_pagos","metodos_pagos.id_metodoPago","=","ordenes.fk_metodoPago")
        ->where("id_orden","=",$id_orden)
        ->first();
        $updatePlatillos=Ordene::select('id_orden','id_menu','cantidad','precio_menu','nombre_menu','cantidad')
        ->join('ordenes_has_menus','ordenes_id_orden','=','id_orden')
        ->join('menus','id_menu','=','menus_id_menu')
        ->where('id_orden','=',$id_orden)
        ->groupBy('id_ordenes_has_menus')
        ->get();

        $platillos = Menu::select('id_menu','nombre_menu','precio_menu')->get();



        return view("updateOrden", compact(["updateOrden","platillos",'updatePlatillos']));

    }

    // LOGICA PARA ACTUALIZAR LA TABLA "ordenes"

    public function update(Request $request, $id_orden)
    {
        $request->validate([
            'cedula' => 'required|numeric|regex:/^[0-9]{2}[0-9]{3}[0-9]{3}$/',
            'platillo' => 'required|exists:menus,id_menu',
            'orden_cantidad' => 'required|numeric|min:1',
            'comentario_adicional' => 'required|string|max:500',
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
            
            
            $ordenUpdate->fk_menu = $request->post('platillo');
            
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

            $saved=$ordenUpdate->save(); // GENERAMOS EL UPDATE EN LA TABLA "ordenes"

            if($saved()){
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
        $item = Ordene::select("id_orden","orden_codigo","orden_estatus",
        "fechaCreacion_orden","cedula","telefono","nombre_metodo",'comentario_adicional')
        ->selectRaw("CONCAT(nombres,' ',apellidos) AS nombre_apellido")
        ->selectRaw("CONCAT(estado,', ',ciudad,', ',municipio,', ',parroquia,', ',punto_referencia) AS direccion")
        ->join("metodos_pagos","metodos_pagos.id_metodoPago","=","ordenes.fk_metodoPago")
        ->join("clientes","clientes.id_cliente","=","ordenes.fk_cliente")
        ->join("personas","personas.id_persona","=","clientes.fk_persona")
        ->join("clientes_x_direcciones","clientes_x_direcciones.fk_cliente","=","clientes.id_cliente")
        ->join("direcciones","clientes_x_direcciones.fk_direccion","=","direcciones.id_direccion")
        ->where("id_orden","=",$id_orden)
        ->groupBy('orden_codigo')
        ->first();

        $platillos= Ordene::select('id_orden','nombre_menu','descripcion_menu','precio_menu','cantidad')
        ->join('ordenes_has_menus','id_orden','=','ordenes_id_orden')
        ->join('menus','id_menu','=','menus_id_menu')
        ->where("id_orden","=",$id_orden)
        ->groupBy('id_ordenes_has_menus')
        ->get();

        return view("deleteOrden",compact('platillos','item'));

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
