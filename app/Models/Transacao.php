<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
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
    protected $table = 'transacoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['valor', 'tipo_transacao_id', 'situacao_transacao_id', 'conta_destino_id', 'conta_origem_id'];

    /** RELATIONSHIPS FUNCTIONS **/
    
    public function tipoTransacao()
    {
        return $this->belongsTo(TipoTransacao::class);
    }

    public function situacaoTransacao()
    {
        return $this->belongsTo(SituacaoTransacao::class);
    }

    public function contaDestino()
    {
        return $this->belongsTo(Conta::class, 'conta_destino_id')->withDefault();
    }

    public function contaOrigem()
    {
        return $this->belongsTo(Conta::class, 'conta_origem_id')->withDefault();
    }
}
