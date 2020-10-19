<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OauthClientsSeeder::class);
        $this->call(TiposContaTableSeeder::class);
        $this->call(SituacoesContaTableSeeder::class);
        $this->call(TiposClienteTableSeeder::class);
        $this->call(SituacoesTransacaoTableSeeder::class);
        $this->call(TiposTransacaoTableSeeder::class);
        $this->call(BancoAgenciaTableSeeder::class);
        $this->call(ClientesSeeder::class);
    }
}
