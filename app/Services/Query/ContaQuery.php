<?php

namespace App\Services\Query;

use App\Repositories\ContaRepository;
use App\Repositories\UserRepository;
use App\Repositories\ContaClienteRepository;

class ContaQuery
{
    /**
     * @var $contaRepository
     */
    protected $contaRepository;

    /**
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * @var $ContaClienteRepository
     */
    protected $contaClienteRepository;

    /**
     * ContaQuery constructor.
     *
     * @param ContaRepository $contaRepository
     */
    public function __construct(ContaRepository $contaRepository, UserRepository $userRepository, ContaClienteRepository $contaClienteRepository)
    {
        $this->contaRepository = $contaRepository;
        $this->userRepository = $userRepository;
        $this->contaClienteRepository = $contaClienteRepository;
    }

    /**
     * Buscar saldo de uma determinada conta.
     *
     * @param $user_id
     * @return String
     */
    public function buscarSaldo($user_id)
    {
        $user = $this->userRepository->fetchOnlyUser($user_id);
        $cc = $this->contaClienteRepository->buscaContaCliente($user->cliente->id);
        return $this->contaRepository->buscaSaldo($cc->conta_id);
    }

}