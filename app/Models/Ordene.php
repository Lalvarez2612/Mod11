<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ordene
 * 
 * @property int $id_orden
 * @property int $fk_cliente
 * @property int $fk_menu
 * @property int $fk_metodoPago
 * @property string $orden_codigo
 * @property int $orden_cantidad
 * @property string $orden_estatus
 * @property string $comentario_adicional
 * @property Carbon $fechaCreacion_orden
 * 
 * @property Cliente $cliente
 * @property Menu $menu
 * @property MetodosPago $metodos_pago
 * @property Collection|AsignacionesXOrdene[] $asignaciones_x_ordenes
 *
 * @package App\Models
 */
class Ordene extends Model
{
	protected $table = 'ordenes';
	protected $primaryKey = 'id_orden';
	public $timestamps = false;

	protected $casts = [
		'fk_cliente' => 'int',
		'fk_menu' => 'int',
		'fk_metodoPago' => 'int',
		'orden_cantidad' => 'int',
		'fechaCreacion_orden' => 'datetime'
	];

	protected $fillable = [
		'fk_cliente',
		'fk_menu',
		'fk_metodoPago',
		'orden_codigo',
		'orden_cantidad',
		'orden_estatus',
		'comentario_adicional',
		'fechaCreacion_orden'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'fk_cliente');
	}

	public function menu()
	{
		return $this->belongsTo(Menu::class, 'fk_menu');
	}

	public function metodos_pago()
	{
		return $this->belongsTo(MetodosPago::class, 'fk_metodoPago');
	}

	public function asignaciones_x_ordenes()
	{
		return $this->hasMany(AsignacionesXOrdene::class, 'fk_orden');
	}
}
