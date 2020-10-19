<?php

namespace App\Services\Command\Conta;

use App\Services\Command\AbstractCommand;
use App\Repositories\TransacaoRepository;
use App\Models\Transacao;


class CancelarTransacaoCommand extends AbstractCommand
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
     * EfetuarSaqueCommand constructor.
     *
     * @param $data
     */
    public function __construct($data)
    {
        parent::__construct($data);

        $this->transacaoRepository = new TransacaoRepository(new Transacao());
    }

    /**
     * Handle command.
     *
     * @return mixed
     */
    public function handle()
    {
        $entityTransacao = $this->transacaoRepository->findOrFail($this->data);
        $transacao = [
            'situacao_transacao_id' => 2,
        ];

        $this->transacaoRepository->update($entityTransacao, $transacao);
        return true;
    }
}