<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConvertionRequest;
use App\Models\Currency;
use App\Services\CurrencyService;
use DateTime;
use ErrorException;
use Exception;
use Illuminate\Support\Facades\Log;

class ConvertionController extends Controller
{
    public function __construct(
        private CurrencyService $service
    )
    {}


    public function index() {
        return view('convert', [
            'currencies' => Currency::query()
                ->orderBy('char_code', 'ASC')
                ->get()
        ]);
    }



    public function convert(ConvertionRequest $request) {
        $data = $request->safe()->only(['from', 'to', 'value', 'date']);

        try {
            $this->service->update();
        } catch (Exception $e) {
            Log::warning($e->getMessage());
        }

        $result = null;

        try {
            if ($request->safe()->has('date')) {
                $result = $this->service->convert(
                    $data['from'],
                    $data['to'],
                    $data['value'],
                    DateTime::createFromFormat('d-m-Y', $data['date'])
                );
            }

            $result = $this->service->convert(
                $data['from'],
                $data['to'],
                $data['value']
            );
        } catch (ErrorException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Возникла неизвестная серверная ошибка'
            ], 500);
        }

        return response()->json([
            'query' => $data,
            'result' => $result
        ], 200);
    }
}
