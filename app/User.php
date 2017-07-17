<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function perfiles()
    {
        return $this->belongsToMany(Perfil::class,'perfil_usuario','id_usuario','id_perfil');
    }

    public function getPermisos()
    {
        $permisos = array();
        $perfiles = $this->perfiles;
//        die(var_dump($perfiles);
        foreach ($perfiles as $perfil)
        {
            foreach ($perfil->permisos as $permiso)
            {
                $permisos[] = $permiso->id_permiso;
            }
        }
        return $permisos;
    }
    
    public function getPerfiles()
    {
        $response = array();
        $perfiles = $this->perfiles;
        foreach ($perfiles as $perfil)
        {
            $response[] = $perfil->id_perfil;
        }
        return $response;
    }
}
