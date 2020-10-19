<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agencia extends Model
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
    protected $table = 'agencias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'numero', 'endereco', 'telefone', 'banco_id'];

    /** RELATIONSHIPS FUNCTIONS **/
    
    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    public function clientes()
    {
        return $this->hasMany(ContaCliente::class);
    }
}
