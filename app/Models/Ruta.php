<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ruta
 * 
 * @property int $id_ruta
 * @property int $fk_orden
 * @property int $fk_direccion
 * 
 * @property Direccione $direccione
 * @property Ordene $ordene
 *
 * @package App\Models
 */
class Ruta extends Model
{
	protected $table = 'rutas';
	protected $primaryKey = 'id_ruta';
	public $timestamps = false;

	protected $casts = [
		'fk_orden' => 'int',
		'fk_direccion' => 'int'
	];

	protected $fillable = [
		'fk_orden',
		'fk_direccion'
	];

	public function direccione()
	{
		return $this->belongsTo(Direccione::class, 'fk_direccion');
	}

	public function ordene()
	{
		return $this->belongsTo(Ordene::class, 'fk_orden');
	}
}
