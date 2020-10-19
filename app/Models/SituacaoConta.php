<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SituacaoConta extends Model
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
    protected $table = 'situacao_conta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'descricao'];
}
