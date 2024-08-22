<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ordenesController;

// RUTA WELCOME
Route::get("/",[ordenesController::class,"welcome"])->name("welcome.index");

// RUTAS PARA CRUD DE ORDENES
Route::get("/ordenes/index",[ordenesController::class,"index"])->name("ordenes.index");
Route::get("/create",[ordenesController::class,"create"])->name("ordenes.create");
Route::post("/store",[ordenesController::class,"store"])->name("ordenes.store");
Route::post("/show",[ordenesController::class,"show"])->name("ordenes.show");
Route::get("/edit/{id_orden}",[ordenesController::class,"edit"])->name("ordenes.edit");
Route::put("/update/{id_orden}",[ordenesController::class,"update"])->name("ordenes.update");
Route::get("/delete/{id_orden}",[ordenesController::class,"delete"])->name("ordenes.delete");
Route::delete("/destroy/{id_orden}",[ordenesController::class,"destroy"])->name("ordenes.destroy");
