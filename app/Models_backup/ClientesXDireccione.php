<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientesXDireccione
 * 
 * @property int $id_clientDirec
 * @property int $fk_cliente
 * @property int $fk_direccion
 * 
 * @property Cliente $cliente
 * @property Direccione $direccione
 *
 * @package App\Models
 */
class ClientesXDireccione extends Model
{
	protected $table = 'clientes_x_direcciones';
	protected $primaryKey = 'id_clientDirec';
	public $timestamps = false;

	protected $casts = [
		'fk_cliente' => 'int',
		'fk_direccion' => 'int'
	];

	protected $fillable = [
		'fk_cliente',
		'fk_direccion'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'fk_cliente');
	}

	public function direccione()
	{
		return $this->belongsTo(Direccione::class, 'fk_direccion');
	}
}
