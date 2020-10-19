<?php

use Illuminate\Database\Seeder;
use App\Models\TipoCliente;

class TiposClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            ['nome' => 'Pessoa Física'],
            ['nome' => 'Pessoa Jurídica'],
        ];

        foreach ($tipos as $tipo) {
            TipoCliente::create($tipo);
            $this->command->info('Registro '. $tipo['nome'] .' inserido com sucesso');
        }
    }
}
