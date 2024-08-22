<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AsigancionesXOrdene
 * 
 * @property int $id_asigancionOrden
 * @property int $fk_repartidor
 * @property int $fk_orden
 * @property Carbon $tiempo_inicio
 * @property Carbon|null $tiempo_final
 * 
 * @property Ordene $ordene
 * @property Repartidore $repartidore
 *
 * @package App\Models
 */
class AsigancionesXOrdene extends Model
{
	protected $table = 'asiganciones_x_ordenes';
	protected $primaryKey = 'id_asigancionOrden';
	public $timestamps = false;

	protected $casts = [
		'fk_repartidor' => 'int',
		'fk_orden' => 'int',
		'tiempo_inicio' => 'datetime',
		'tiempo_final' => 'datetime'
	];

	protected $fillable = [
		'fk_repartidor',
		'fk_orden',
		'tiempo_inicio',
		'tiempo_final'
	];

	public function ordene()
	{
		return $this->belongsTo(Ordene::class, 'fk_orden');
	}

	public function repartidore()
	{
		return $this->belongsTo(Repartidore::class, 'fk_repartidor');
	}
}
