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
use Illuminate\Support\Facades\DB;
use Exception;

class EfetuarDepositoCommand extends AbstractCommand
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
        $this->transacaoRepository = new TransacaoRepository(new Transacao());
        $this->contaRepository = new ContaRepository(new Conta());
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
            DB::beginTransaction();
       
            $transacao = [
                'valor' => floatval($valor),
                'tipo_transacao_id' => 1,
                'situacao_transacao_id' => 1,
                'conta_destino_id' => $cc->conta_id
            ];
            $entity = $this->transacaoRepository->create($transacao);

            
            $conta->saldo = ($conta->saldo + $valor);
            $conta->save();

            DB::commit();

            return $entity;
        } else {
            throw new Exception('Não é permitido depósitos em conta poupança');
        }
    }
}