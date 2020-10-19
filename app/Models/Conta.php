<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Conta extends Model
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
    protected $table = 'contas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['numero', 'saldo', 'limite_saque', 'tipo_conta_id', 'situacao_conta_id'];

    /** RELATIONSHIPS FUNCTIONS **/

    public function situacaoConta()
    {
        return $this->belongsTo(SituacaoConta::class);
    }

    public function tipoConta()
    {
        return $this->belongsTo(TipoConta::class);
    }

    public function saques()
    {
        return $this->hasMany(Transacao::class, 'conta_origem_id');
    }

    public function depositos()
    {
        return $this->hasMany(Transacao::class, 'conta_destino_id');
    }
}
