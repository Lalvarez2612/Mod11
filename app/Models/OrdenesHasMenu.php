<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdenesHasMenu
 * 
 * @property int $id_ordenes_has_menus
 * @property int $ordenes_id_orden
 * @property int $menus_id_menu
 * @property int $cantidad
 * 
 * @property Menu $menu
 * @property Ordene $ordene
 *
 * @package App\Models
 */
class OrdenesHasMenu extends Model
{
	protected $table = 'ordenes_has_menus';
	protected $primaryKey = 'id_ordenes_has_menus';
	public $timestamps = false;

	protected $casts = [
		'ordenes_id_orden' => 'int',
		'menus_id_menu' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'ordenes_id_orden',
		'menus_id_menu',
		'cantidad'
	];

	public function menu()
	{
		return $this->belongsTo(Menu::class, 'menus_id_menu');
	}

	public function ordene()
	{
		return $this->belongsTo(Ordene::class, 'ordenes_id_orden');
	}
}
