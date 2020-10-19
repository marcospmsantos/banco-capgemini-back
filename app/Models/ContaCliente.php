<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContaCliente extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'contas_cliente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cliente_id', 'conta_id', 'agencia_id'];

    /** RELATIONSHIPS FUNCTIONS **/

    public function agencia()
    {
        return $this->belongsTo(Agencia::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }
}
