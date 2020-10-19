<?php

use Illuminate\Database\Seeder;
use App\Models\TipoConta;

class TiposContaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            ['nome' => 'Corrente'],
            ['nome' => 'Poupança'],
        ];

        foreach ($tipos as $tipo) {
            TipoConta::create($tipo);
            $this->command->info('Registro '. $tipo['nome'] .' inserido com sucesso');
        }
    }
}
