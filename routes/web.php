<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ordenesController;
use App\Http\Controllers\asignacionesController;
use App\Http\Controllers\entregasController;
use Illuminate\Http\Request;

// RUTAS GENERALES: (WELCOME, ORDENES, RUTAS ASIGNADAS Y ENTREGAS)
Route::get("/",[ordenesController::class,"welcome"])->name("welcome.index");
Route::get("/ordenes/index",[ordenesController::class,"index"])->name("ordenes.index");
Route::get("/rutas/index",[asignacionesController::class,"index"])->name("rutas.index");
Route::get("/entregas/index",[entregasController::class,"index"])->name("entregas.index");

// RUTAS PARA CRUD DE ORDENES
Route::get("/ordenes/create",[ordenesController::class,"create"])->name("ordenes.create");
Route::post("/ordenes/store",[ordenesController::class,"store"])->name("ordenes.store");
Route::post("/ordenes/show",[ordenesController::class,"show"])->name("ordenes.show");
Route::get("/ordenes/edit/{id_orden}",[ordenesController::class,"edit"])->name("ordenes.edit");
Route::put("/ordenes/update/{id_orden}",[ordenesController::class,"update"])->name("ordenes.update");
Route::get("/ordenes/delete/{id_orden}",[ordenesController::class,"delete"])->name("ordenes.delete");
Route::delete("/ordenes/destroy/{id_orden}",[ordenesController::class,"destroy"])->name("ordenes.destroy");
Route::get('/ordenes/create/{id}',[ordenesController::class, 'calculo']);

// RUTAS PARA ASIGNACIONES DE ORDENES Y CREAR O VER LAS RUTAS
Route::get("/asignacion/{id_orden}",[asignacionesController::class,"create"])->name("asignacion.create");
Route::get("/asignacion/crear/ruta/{id_orden}/{id_repartidor}/",[asignacionesController::class,"crearRuta"])->name("asignacion.crearRuta");
Route::post("/asignacion/store/{id_orden}/{id_repartidor}/",[asignacionesController::class,"store"])->name("asignacion.store");
Route::post("/asignacion/show",[asignacionesController::class,"show"])->name("asignacion.show");
Route::post("/asignacion/findCodigo",[asignacionesController::class,"findCodigo"])->name("asignacion.findCodigo");
Route::get("/asignacion/ruta/{id_ruta}",[asignacionesController::class,"findRuta"])->name("asignacion.findRuta");

// RUTA PARA LAS ORDENES ENTREGADAS
Route::post("/entregas/show",[entregasController::class,"show"])->name("entregas.show");



//intento de api
/*
Route::get('/api', function(){
    return view('prueba');
});

Route::post('/api/save-coordinates', function(Request $request){
    $lat = $request->input('lat');
    $lon = $request->input('lon');

    return view('prueba',compact('lat','lon'));
}); */ 
