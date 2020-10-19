<?php

namespace App\Repositories;

use App\Models\ContaCliente;

class ContaClienteRepository
{
    /**
     * @var ContaCliente
     */
    protected $conta_cliente;

    /**
     * ContaRepository constructor.
     *
     * @param ContaCliente $conta
     */
    public function __construct(ContaCliente $conta_cliente)
    {
        $this->conta_cliente = $conta_cliente;
    }

    /**
     * Buscar conta do cliente
     *
     * @param $id
     * @return mixed
     */
    public function buscaContaCliente($id)
    {
        return $this->conta_cliente
            ->where('cliente_id', $id)
            ->first();
    }
}
