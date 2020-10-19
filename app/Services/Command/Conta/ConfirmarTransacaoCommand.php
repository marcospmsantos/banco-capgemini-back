<?php

namespace App\Services\Command\Conta;

use App\Services\Command\AbstractCommand;
use App\Repositories\TransacaoRepository;
use App\Models\Transacao;
use App\Repositories\ContaRepository;
use App\Models\Conta;
use Illuminate\Support\Facades\DB;

class ConfirmarTransacaoCommand extends AbstractCommand
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
        DB::beginTransaction();

        $entityTransacao = $this->transacaoRepository->findOrFail($this->data);
        $transacao = [
            'situacao_transacao_id' => 1,
        ];

        $this->transacaoRepository->update($entityTransacao, $transacao);

        $entityConta = $this->contaRepository->findOrFail(
            $entityTransacao->tipo_transacao_id == 1 ? $entityTransacao->conta_destino_id : $entityTransacao->conta_origem_id
        );
        $entityConta->saldo = ($entityConta->saldo - $entityTransacao->valor);
        $entityConta->save();

        DB::commit();
        return true;
    }
}