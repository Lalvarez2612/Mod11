<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 * 
 * @property int $id_persona
 * @property int $cedula
 * @property string $nombres
 * @property string $apellidos
 * @property string $genero
 * @property Carbon $fecha_nacimiento
 * 
 * @property Collection|Cliente[] $clientes
 * @property Collection|Repartidore[] $repartidores
 *
 * @package App\Models
 */
class Persona extends Model
{
	protected $table = 'personas';
	protected $primaryKey = 'id_persona';
	public $timestamps = false;

	protected $casts = [
		'cedula' => 'int',
		'fecha_nacimiento' => 'datetime'
	];

	protected $fillable = [
		'cedula',
		'nombres',
		'apellidos',
		'genero',
		'fecha_nacimiento'
	];

	public function clientes()
	{
		return $this->hasMany(Cliente::class, 'fk_persona');
	}

	public function repartidores()
	{
		return $this->hasMany(Repartidore::class, 'fk_persona');
	}
}
