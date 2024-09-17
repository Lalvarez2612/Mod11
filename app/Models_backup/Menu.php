<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 * 
 * @property int $id_menu
 * @property string $nombre_menu
 * @property string $descripcion_menu
 * @property int $precio_menu
 * 
 * @property Collection|Ordene[] $ordenes
 *
 * @package App\Models
 */
class Menu extends Model
{
	protected $table = 'menus';
	protected $primaryKey = 'id_menu';
	public $timestamps = false;

	protected $casts = [
		'precio_menu' => 'int'
	];

	protected $fillable = [
		'nombre_menu',
		'descripcion_menu',
		'precio_menu'
	];

	public function ordenes()
	{
		return $this->hasMany(Ordene::class, 'fk_menu');
	}
}
