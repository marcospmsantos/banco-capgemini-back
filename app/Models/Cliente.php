<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'clientes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['endereco', 'tipo_cliente_id', 'user_id'];

    /** RELATIONSHIPS FUNCTIONS **/
    
    public function tipoCliente()
    {
        return $this->belongsTo(TipoCliente::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function contas()
    {
        return $this->hasMany(ContaCliente::class);
    }
}
