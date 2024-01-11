<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\CurrencyRate;
use App\Models\Update;
use DateTime;
use ErrorException;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class CurrencyService {
  public function update(): void {
    $lastUpdate = Update::query()
      ->latest('created')
      ->first();
    
    if ($lastUpdate !== null && date('Ymd') == date('Ymd', strtotime($lastUpdate->created))) {
      return;
    }
  
    $response = Http::get('https://www.cbr.ru/scripts/XML_daily.asp');

    $response->throwUnlessStatus(200);

    $xml = simplexml_load_string($response->body());

    if (! $xml) {
      throw new RuntimeException('Произошла ошибка при парсиге валют.');
    }

    $currencies = $xml->Valute;

    for ($i = 0; $i < count($currencies); $i++) {
      Currency::updateOrCreate(
        ['id' => $currencies[$i]['ID']],
        [
          'id' => $currencies[$i]['ID'],
          'num_code' => $currencies[$i]->NumCode,
          'char_code' => $currencies[$i]->CharCode,
          'name' => $currencies[$i]->Name
        ]
      );
    }
    
    $newUpdateId = Update::create([
      'created' => Date::now()
    ])->id;
  
    for ($i = 0; $i < count($currencies); $i++) {
      CurrencyRate::create([
        'currency_id' => $currencies[$i]['ID'],
        'update_id' => $newUpdateId,
        'nominal' => $currencies[$i]->Nominal,
        'value' => str_replace(',', '.', $currencies[$i]->Value)
      ]);
    }
  }

  public function convert(string $fromCharCode, string $toCharCode, float $value, ?DateTime $date = null): float{
    $from = Currency::query()
      ->where('char_code', '=', $fromCharCode)
      ->first();
  
    $to = Currency::query()
      ->where('char_code', '=', $toCharCode)
      ->first();

    $updateId = $date === null ?
      Update::query()
        ->orderBy('created', 'DESC')
        ->value('id') : 
      Update::query()
        ->where('created', '=', $date)
        ->orderBy('created', 'DESC')
        ->value('id');

    if ($updateId === null) {
      throw new ErrorException('Не удалось найти обновление');
    }

    $fromRate = $from->char_code === 'RUB' ? 
      CurrencyRate::query()
        ->where('currency_id', '=', $from->id)
        ->where('update_id', '=', $updateId)
        ->first() :
      CurrencyRate::query()
        ->where('currency_id', '=', $from->id)
        ->first();

    $toRate = $to->char_code === 'RUB' ?
      CurrencyRate::query()
        ->where('currency_id', '=', $to->id)
        ->where('update_id', '=', $updateId)
        ->first() :
      CurrencyRate::query()
        ->where('currency_id', '=', $to->id)
        ->first();

    if ($fromRate === null || $toRate === null) {
      throw new ErrorException('Не удалось найти курс с этим обновлением');
    }

    return ($fromRate->nominal * $fromRate->value * $value) / 
           ($toRate->nominal * $toRate->value);
  }
}

?>
