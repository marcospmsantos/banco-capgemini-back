<?php

use Illuminate\Database\Seeder;
use App\Models\SituacaoTransacao;

class SituacoesTransacaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $situacoes = [
            ['nome' => 'Efetivada'],
            ['nome' => 'Cancelada'],
            ['nome' => 'Aguardando validação'],
            ['nome' => 'Estornada'],
            ['nome' => 'Bloqueio Judicial'],
        ];

        foreach ($situacoes as $situacao) {
            SituacaoTransacao::create($situacao);
            $this->command->info('Registro '. $situacao['nome'] .' inserido com sucesso');
        }
    }
}
