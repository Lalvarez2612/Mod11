<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 * 
 * @property int $id_cliente
 * @property int $fk_persona
 * @property string $telefono
 * 
 * @property Persona $persona
 * @property Collection|Direccione[] $direcciones
 * @property Collection|Ordene[] $ordenes
 *
 * @package App\Models
 */
class Cliente extends Model
{
	protected $table = 'clientes';
	protected $primaryKey = 'id_cliente';
	public $timestamps = false;

	protected $casts = [
		'fk_persona' => 'int'
	];

	protected $fillable = [
		'fk_persona',
		'telefono'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'fk_persona');
	}

	public function direcciones()
	{
		return $this->belongsToMany(Direccione::class, 'clientes_x_direcciones', 'fk_cliente', 'fk_direccion')
					->withPivot('id_clientDirec');
	}

	public function ordenes()
	{
		return $this->hasMany(Ordene::class, 'fk_cliente');
	}
}
