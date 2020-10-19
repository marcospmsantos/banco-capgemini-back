<?php

use Illuminate\Database\Seeder;
use App\Models\TipoTransacao;

class TiposTransacaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            ['nome' => 'Entrada'],
            ['nome' => 'Saída'],
        ];

        foreach ($tipos as $tipo) {
            TipoTransacao::create($tipo);
            $this->command->info('Registro '. $tipo['nome'] .' inserido com sucesso');
        }
    }
}
