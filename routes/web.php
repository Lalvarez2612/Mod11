<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ordenesController;
use App\Http\Controllers\asignacionesController;

// RUTAS GENERALES: (WELCOME, ORDENES, RUTAS ASIGNADAS Y ENTREGAS)
Route::get("/",[ordenesController::class,"welcome"])->name("welcome.index");
Route::get("/ordenes/index",[ordenesController::class,"index"])->name("ordenes.index");
Route::get("/rutas/index",[asignacionesController::class,"index"])->name("rutas.index");

// RUTAS PARA CRUD DE ORDENES
Route::get("/ordenes/create",[ordenesController::class,"create"])->name("ordenes.create");
Route::post("/ordenes/store",[ordenesController::class,"store"])->name("ordenes.store");
Route::post("/ordenes/show",[ordenesController::class,"show"])->name("ordenes.show");
Route::get("/ordenes/edit/{id_orden}",[ordenesController::class,"edit"])->name("ordenes.edit");
Route::put("/ordenes/update/{id_orden}",[ordenesController::class,"update"])->name("ordenes.update");
Route::get("/ordenes/delete/{id_orden}",[ordenesController::class,"delete"])->name("ordenes.delete");
Route::delete("/ordenes/destroy/{id_orden}",[ordenesController::class,"destroy"])->name("ordenes.destroy");

// RUTAS PARA ASIGNACIONES DE ORDENES
Route::get("/asignacion/{id_orden}",[asignacionesController::class,"create"])->name("asignacion.create");
Route::get("/asignacion/store/{id_orden}/{id_repartidor}/",
[asignacionesController::class,"store"])->name("asignacion.store");
Route::post("/asignacion/show",[asignacionesController::class,"show"])->name("asignacion.show");
Route::post("/asignacion/findCodigo",[asignacionesController::class,"findCodigo"])->name("asignacion.findCodigo");
