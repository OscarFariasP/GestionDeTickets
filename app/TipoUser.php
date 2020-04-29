<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class TipoUser extends Model
{
    protected $table = 'tipo_usuario'; 
    public $timestamps = false; // Deshabilitar timestamps
    protected $fillable = [
        'nombre'
    ];

    public function users()
    {
        return $this->hasMany(User::class,'id');
    }
}
