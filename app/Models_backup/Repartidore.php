<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Repartidore
 * 
 * @property int $id_repartidor
 * @property int $fk_persona
 * @property string $estatus_repartidor
 * @property string $vehiculo_descripcion
 * 
 * @property Persona $persona
 * @property Collection|AsignacionesXOrdene[] $asignaciones_x_ordenes
 *
 * @package App\Models
 */
class Repartidore extends Model
{
	protected $table = 'repartidores';
	protected $primaryKey = 'id_repartidor';
	public $timestamps = false;

	protected $casts = [
		'fk_persona' => 'int'
	];

	protected $fillable = [
		'fk_persona',
		'estatus_repartidor',
		'vehiculo_descripcion'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'fk_persona');
	}

	public function asignaciones_x_ordenes()
	{
		return $this->hasMany(AsignacionesXOrdene::class, 'fk_repartidor');
	}
}
