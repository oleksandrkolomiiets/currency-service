<?php

namespace App\Services;

use App\Repositories\CurrencyRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class CurrencyService
{
    protected $url = 'http://www.cbr.ru/scripts/XML_daily.asp';
    protected CurrencyRepository $repository;

    /**
     * CurrencyService constructor.
     * @param CurrencyRepository $repository
     */
    public function __construct(CurrencyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return bool
     */
    public function fetchAndInsert(): bool
    {
        try {
            $result = Http::get($this->url)->body();
            $xml = json_encode(new SimpleXMLElement($result));
            $data = $this->parse(json_decode($xml, true));

            return $this->repository->insert($data);
        } catch (\Exception $exception) {
            info('Something went wrong at ' . __CLASS__ . '#' . __LINE__);

            return false;
        }
    }

    /**
     * @param array $data
     * @return array
     */
    private function parse(array $data): array
    {
        $date = $data['@attributes']['Date'];
        $currencies = [];

        foreach ($data['Valute'] as $currency) {
            $currencies[] = [
                'code' => $currency['CharCode'],
                'name' => $currency['Name'],
                'rate' => (float) str_replace(['.', ','], ['', '.'], $currency['Value']),
                'nominal' => (int) $currency['Nominal'],
                'date' => Carbon::parse($date)->toDate(),
                'created_at' => now(),
            ];
        }

        return $currencies;
    }
}
