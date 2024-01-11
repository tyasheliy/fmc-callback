<?php

namespace Tests\Feature;

use App\Services\CurrencyService;
use Tests\TestCase;

class ConvertTest extends TestCase
{
    public function test_convert_endpoint(): void
    {
        $spy = $this->spy(CurrencyService::class);

        $fromCharCode = 'RUB';
        $toCharCode = 'RUB';
        $value = '1';

        $url = '/api/convert?from=' . $fromCharCode . '&to=' . $toCharCode . '&value=' . $value;

        $response = $this->get($url);

        $response->assertStatus(200);
    
        $spy->shouldHaveReceived('update');
        $spy->shouldHaveReceived('convert', [$fromCharCode, $toCharCode, $value]);
    }
}
