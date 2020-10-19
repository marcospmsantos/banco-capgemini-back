<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Banco;
use App\Models\Agencia;

class BancoAgenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_banco = [
            'nome' => 'Banco Capgemini',
            'cnpj' => '85.112.045/0001-00',
            'codigo' => '059',
            'sac' => '0800 171 2020'
        ];

        $banco = Banco::create($array_banco);

        $array_agencia = [
            [
                'nome' => 'Capgemini',
                'numero' => '00001',
                'endereco' => Str::random(30),
                'telefone' => '0800 171 2020',
                'banco_id' => $banco->id
            ],
        ];

        foreach ($array_agencia as $agencia) {
            Agencia::create($agencia);
            $this->command->info('Registro '. $agencia['nome'] .' inserido com sucesso');
        }
    }
}
