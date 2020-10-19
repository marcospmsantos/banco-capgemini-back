<?php

namespace App\Repositories;

use App\Models\Conta;
use App\Helper\Number;

class ContaRepository extends AbstractRepository
{
    /**
     * @var Conta
     */
    protected $model;

    /**
     * ContaRepository constructor.
     *
     * @param Conta $conta
     */
    public function __construct(Conta $conta)
    {
        $this->model = $conta;
    }

    /**
     * Buscar tipo da conta do cliente
     *
     * @param $id
     * @return mixed
     */
    public function buscaTipoConta($id)
    {
        $query = $this->model
            ->select('tipo_conta_id')
            ->where('id', $id)
            ->first();
        return $query;
    }

    /**
     * Buscar saldo da conta do cliente
     *
     * @param $id
     * @return mixed
     */
    public function buscaSaldo($id, $format = true)
    {
        $query = $this->model
            ->select('saldo')
            ->where('id', $id)
            ->first();
        return $format ? $this->formatParams($query) : array('saldo' => $query->saldo);
    }

    /**
     * Buscar limite de saque da conta do cliente
     *
     * @param $id
     * @return mixed
     */
    public function buscaLimiteSaque($id, $format = true)
    {
        $query = $this->model
            ->select('limite_saque')
            ->where('id', $id)
            ->first();
        return $format ? $this->formatParams($query) : array('limite_saque' => $query->limite_saque);
    }

    public function formatParams($params)
    {
        $formatted = [];

        if (isset($params->saldo)) {
            $formatted['saldo'] = Number::formatCurrencyBr($params->saldo, false);
        }

        if (isset($params->limite_saque)) {
            $formatted['limite_saque'] = Number::formatCurrencyBr($params->limite_saque, false);
        }

        return $formatted;
    }
}
