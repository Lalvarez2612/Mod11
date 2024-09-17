<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Direccione
 * 
 * @property int $id_direccion
 * @property string $estado
 * @property string $ciudad
 * @property string $municipio
 * @property string $parroquia
 * @property string $punto_referencia
 * @property string $latitud
 * @property string $longitud
 * 
 * @property Collection|Cliente[] $clientes
 * @property Collection|Ruta[] $rutas
 *
 * @package App\Models
 */
class Direccione extends Model
{
	protected $table = 'direcciones';
	protected $primaryKey = 'id_direccion';
	public $timestamps = false;

	protected $fillable = [
		'estado',
		'ciudad',
		'municipio',
		'parroquia',
		'punto_referencia',
		'latitud',
		'longitud'
	];

	public function clientes()
	{
		return $this->belongsToMany(Cliente::class, 'clientes_x_direcciones', 'fk_direccion', 'fk_cliente')
					->withPivot('id_clientDirec');
	}

	public function rutas()
	{
		return $this->hasMany(Ruta::class, 'fk_direccion');
	}
}
