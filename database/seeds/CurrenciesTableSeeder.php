<?php

use App\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Criando registros no banco de dados com siglas das moedas, nome das moedas e cotação do dia 11/06/2021 com base no USD.
        Currency::create([
            'initials'      => 'USD',
            'description'   =>  'United States Dollar',
            'money_backing' => 1
        ]);

        Currency::create([
            'initials'      => 'BRL',
            'description'   =>  'Brazilian Real',
            'money_backing' => 0.1954
        ]);

        Currency::create([
            'initials'      => 'EUR',
            'description'   =>  'Euro',
            'money_backing' => 1.2109
        ]);

        Currency::create([
            'initials'      => 'BTC',
            'description'   =>  'Bitcoin',
            'money_backing' =>  35402.00
        ]);

        Currency::create([
            'initials'      => 'ETH',
            'description'   =>  'Ether',
            'money_backing' =>  2290.24
        ]);
    }
}
