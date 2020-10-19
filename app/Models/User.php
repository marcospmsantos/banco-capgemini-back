<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'avatar', 'telefone', 'celular', 'cpf_cnpj'];

    /**
     * In roles
     * @var string
     */
    protected $guard_name = 'api';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'cliente'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'photo_url',
        'numero_agencia',
        'numero_conta'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the client record associated with the user.
     */
    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        if (!$this->avatar) {
            return url('https://rothink.dev/assets/images/me.png');
        }

        return $this->avatar;
    }

    public function getNumeroAgenciaAttribute()
    {
        $contaCliente = $this->cliente->contas[0];
        $agencia = $contaCliente->agencia->numero;
        return $agencia;
    }

    public function getNumeroContaAttribute()
    {
        $contaCliente = $this->cliente->contas[0];
        $conta = $contaCliente->conta->numero;
        return $conta;
    }
    
}
