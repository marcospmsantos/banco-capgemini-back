<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Services\Command\Conta\EfetuarSaqueCommand;
use App\Services\Command\Conta\EfetuarDepositoCommand;
use App\Services\Command\Conta\ConfirmarTransacaoCommand;
use App\Services\Command\Conta\CancelarTransacaoCommand;
use App\Http\Requests\SaqueRequest;
use App\Http\Requests\DepositoRequest;
use Exception;

class TransacaoController extends Controller
{
    /**
     * Retorna uma transação de saque em uma conta.
     *
     * @param  SaqueRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saque(SaqueRequest $request)
    {
        try {
            $params = $request->all();
            $params['user_id'] = $request->user()->id;
            $command = new EfetuarSaqueCommand($params);
            $response = $command->handle();

            return $this->success('Operação realizada com com sucesso', ['response' => $response]);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Confirmar transação
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmacao(Request $request, int $id)
    {
        try {
            $command = new ConfirmarTransacaoCommand($id);
            $command->handle();

            return $this->success('Confirmado com sucesso');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Confirmar transação
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelar(Request $request, int $id)
    {
        try {
            $command = new CancelarTransacaoCommand($id);
            $command->handle();

            return $this->success('Operação cancelada com sucesso');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Retorna uma transação de deposito em uma conta.
     *
     * @param  DepositoRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deposito(DepositoRequest $request)
    {
        try {
            $params = $request->all();
            $params['user_id'] = $request->user()->id;
            $command = new EfetuarDepositoCommand($params);
            $response = $command->handle();

            return $this->success('Operação realizada com com sucesso', ['response' => $response]);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
