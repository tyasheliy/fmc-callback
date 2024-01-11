<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Currency;
use App\Models\CurrencyRate;
use App\Models\Update;
use App\Services\CurrencyService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $rubId = Currency::create([
            'id' => 'R00000',
            'num_code' => '000',
            'char_code' => 'RUB',
            'name' => 'Российский рубль'
        ])->id;

        $service = new CurrencyService;

        $service->update();

        CurrencyRate::create([
            'nominal' => 1,
            'value' => 1,
            'update_id' => Update::query()->value('id'),
            'currency_id' => $rubId
        ]);
    }
}
