<?php

namespace App\Services;

use App\Repositories\ContaRepository;


class ContaService
{
    /**
     * @var $contaRepository
     */
    protected $contaRepository;

    /**
     * ContaService constructor.
     *
     * @param ContaRepository $contaRepository
     */
    public function __construct(ContaRepository $contaRepository)
    {
        $this->contaRepository = $contaRepository;
    }

    /**
     * Buscar saldo de uma determinada conta.
     *
     * @param $id
     * @return String
     */
    public function buscarSaldo($cliente, $conta, $agencia)
    {
        return $this->contaRepository->buscaSaldo($cliente, $conta, $agencia);
    }

}