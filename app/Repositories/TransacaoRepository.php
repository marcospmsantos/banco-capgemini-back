<?php

namespace App\Repositories;

use App\Models\Transacao;


class TransacaoRepository extends AbstractRepository
{
    /**
     * @var Transacao
     */
    protected $model;

    /**
     * TransacaoRepository constructor.
     *
     * @param Transacao $transacao
     */
    public function __construct(Transacao $transacao)
    {
        $this->model = $transacao;
    }
}
