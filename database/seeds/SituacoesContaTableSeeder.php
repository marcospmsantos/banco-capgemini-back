<?php

use Illuminate\Database\Seeder;
use App\Models\SituacaoConta;

class SituacoesContaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $situacoes = [
            ['nome' => 'Ativa'],
            ['nome' => 'Inativa'],
            ['nome' => 'Bloqueada'],
        ];

        foreach ($situacoes as $situacao) {
            SituacaoConta::create($situacao);
            $this->command->info('Registro '. $situacao['nome'] .' inserido com sucesso');
        }
    }
}
