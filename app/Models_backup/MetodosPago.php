<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MetodosPago
 * 
 * @property int $id_metodoPago
 * @property string $nombre_metodo
 * 
 * @property Collection|Ordene[] $ordenes
 *
 * @package App\Models
 */
class MetodosPago extends Model
{
	protected $table = 'metodos_pagos';
	protected $primaryKey = 'id_metodoPago';
	public $timestamps = false;

	protected $fillable = [
		'nombre_metodo'
	];

	public function ordenes()
	{
		return $this->hasMany(Ordene::class, 'fk_metodoPago');
	}
}
