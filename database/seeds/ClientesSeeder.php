<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Agencia;
use App\Models\TipoCliente;
use App\Models\SituacaoConta;
use App\Models\TipoConta;
use App\Models\Cliente;
use App\Models\Conta;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'Admin',
            'cpf_cnpj' => '00700700757',
            'telefone' => '6132310203',
            'celular' => '61981355287',
            'email'=>'admin@user.com',
            'password'=> bcrypt('123456')
        ]);

        $cliente = Cliente::create([
            'endereco' => Str::random(40),
            'tipo_cliente_id' => TipoCliente::where('nome', 'Pessoa Física')->first()->id,
            'user_id' => $user->id
        ]);

        $conta = Conta::create([
            'numero' => '62000-' . $user->id,
            'saldo' => random_int(0, 5000),
            'tipo_conta_id' => TipoConta::find(rand(1,2))->id,
            'situacao_conta_id' => SituacaoConta::where('nome', 'Ativa')->first()->id,
        ]);

        DB::table('contas_cliente')->insert([
            'cliente_id' => $cliente->id,
            'conta_id' => $conta->id,
            'agencia_id' => Agencia::where('numero', '00001')->first()->id,
        ]);

        factory(User::class, 8)->create()->each(function($u) {
            $cliente = Cliente::create([
                'endereco' => Str::random(40),
                'tipo_cliente_id' => TipoCliente::where('nome', 'Pessoa Física')->first()->id,
                'user_id' => $u->id
            ]);

            $conta = Conta::create([
                'numero' => '62000-' . $u->id,
                'saldo' => random_int(0, 5000),
                'tipo_conta_id' => TipoConta::find(rand(1,2))->id,
                'situacao_conta_id' => SituacaoConta::where('nome', 'Ativa')->first()->id,
            ]);

            DB::table('contas_cliente')->insert([
                'cliente_id' => $cliente->id,
                'conta_id' => $conta->id,
                'agencia_id' => Agencia::where('numero', '00001')->first()->id,
            ]);
        });
    }
}
