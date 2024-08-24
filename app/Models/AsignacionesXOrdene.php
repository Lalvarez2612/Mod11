<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AsignacionesXOrdene
 * 
 * @property int $id_asignacionOrden
 * @property int $fk_repartidor
 * @property int $fk_orden
 * @property Carbon $tiempo_inicio
 * @property Carbon|null $tiempo_final
 * @property Carbon $fecha_asignacion
 * 
 * @property Ordene $ordene
 * @property Repartidore $repartidore
 *
 * @package App\Models
 */
class AsignacionesXOrdene extends Model
{
	protected $table = 'asignaciones_x_ordenes';
	protected $primaryKey = 'id_asignacionOrden';
	public $timestamps = false;

	protected $casts = [
		'fk_repartidor' => 'int',
		'fk_orden' => 'int',
		'tiempo_inicio' => 'datetime',
		'tiempo_final' => 'datetime',
		'fecha_asignacion' => 'datetime'
	];

	protected $fillable = [
		'fk_repartidor',
		'fk_orden',
		'tiempo_inicio',
		'tiempo_final',
		'fecha_asignacion'
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
