<?php

namespace App;
use App\TipoUser;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'user'; 
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'pass',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pass', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->pass;
    }
    public function getId()
    {
    return $this->id;
    }

    public function getRol()
    {
        return $this->belongsTo(TipoUser::class,'id_tipouser','id');
    }

    public function authorizeRoles($roles)
    {
        
        if ($this->hasAnyRole($roles)) 
        {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) 
            {
                
                if ($this->hasRole($role)) 
                {                  
                    return true;
                }
            }
        }else 
        {
            if ($this->hasRole($roles)) 
            {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
        
        if (strcmp(strtolower($this->getRol->nombre),strtolower($role))==0) 
        {
            return true;
        }
        return false;
    }
    public function isAdmin()
    {

        if (strcmp(strtolower($this->getRol->name),strtolower('Administrador'))==0) 
        {
            return true;
        }
        return false;        

    }

}
