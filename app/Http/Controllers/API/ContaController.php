<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Services\Query\ContaQuery;
use Exception;

class ContaController extends Controller
{
    /**
     * @var ContaQuery
     */
    protected $contaService;

    /**
     * ContaController Constructor
     *
     * @param ContaService $contaService
     *
     */
    public function __construct(ContaQuery $contaService)
    {
        $this->contaService = $contaService;
    }

    /**
     * Retorna o saldo da conta do cliente.
     *
     * @param int $cliente_id
     * @param int $conta_id
     * @param int $agencia_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saldo(Request $request)
    {
        try {
            $result['data'] = $this->contaService->buscarSaldo($request->user()->id);

            return response()->json($result, 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
