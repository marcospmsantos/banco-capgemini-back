<?php

namespace App\Services\Command\Conta;

use App\Services\Command\AbstractCommand;
use App\Repositories\TransacaoRepository;
use App\Models\Transacao;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Repositories\ContaClienteRepository;
use App\Models\ContaCliente;
use App\Repositories\ContaRepository;
use App\Models\Conta;
use Exception;

class EfetuarSaqueCommand extends AbstractCommand
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var $transacaoRepository
     */
    protected $transacaoRepository;

    /**
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * @var $ContaClienteRepository
     */
    protected $contaClienteRepository;

    /**
     * @var $contaRepository
     */
    protected $contaRepository;

    /**
     * EfetuarSaqueCommand constructor.
     *
     * @param $data
     */
    public function __construct($data)
    {
        parent::__construct($data);
        $this->data = collect($data);

        $this->userRepository = new UserRepository(new User());
        $this->contaClienteRepository = new ContaClienteRepository(new ContaCliente());
        $this->contaRepository = new ContaRepository(new Conta());
        $this->transacaoRepository = new TransacaoRepository(new Transacao());
    }

    /**
     * Handle command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->userRepository->fetchOnlyUser($this->data['user_id']);
        $cc = $this->contaClienteRepository->buscaContaCliente($user->cliente->id);
        $conta = $this->contaRepository->findOrFail($cc->conta_id);
        $valor = $this->data['valor'];
       
        /* Verifica se a conta é corrente */
        if ($conta->tipo_conta_id == 1) {
            /* Verifica se a conta tem saldo disponivel */
            if (floatval($conta->saldo) >= floatval($valor)) {
                /* Verifica se a conta tem limite de saque */
                if (!is_null($conta->limite_saque) && floatval($conta->limite_saque) < floatval($valor)) {
                    throw new Exception('Limite para saque excedido.');
                } else {
                    $transacao = [
                        'valor' => floatval($valor),
                        'tipo_transacao_id' => 2,
                        'situacao_transacao_id' => 3,
                        'conta_origem_id' => $cc->conta_id
                    ];
                    return $this->transacaoRepository->create($transacao);
                }
            } else {
                throw new Exception('Saldo insuficiente');
            }
        } else {
            throw new Exception('Não é permitido saque de conta poupança');
        }
    }
}