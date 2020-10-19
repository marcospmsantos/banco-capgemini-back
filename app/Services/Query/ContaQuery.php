<?php

namespace App\Services\Query;

use App\Repositories\ContaRepository;
use App\Repositories\UserRepository;
use App\Repositories\ContaClienteRepository;
use Exception;

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
        $res = $this->contaRepository->buscaTipoConta($cc->conta_id);
        
        /* Verifica se a conta é corrente */
        if ($res->tipo_conta_id == 1) {
            return $this->contaRepository->buscaSaldo($cc->conta_id);
        } else {
            throw new Exception('Não é permitida consulta de saldo em conta poupança');
        }
    }

}