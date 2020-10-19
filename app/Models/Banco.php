<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
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
    protected $table = 'bancos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'cnpj', 'codigo', 'sac'];

    /** RELATIONSHIPS FUNCTIONS **/
    public function agencias()
    {
        return $this->hasMany(Agencia::class);
    }
}
