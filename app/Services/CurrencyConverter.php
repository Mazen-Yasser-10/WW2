<?php

namespace App\Services;

class CurrencyConverter
{
    private $from_dolar_to_curr = [];
    public function __construct()
    {
        $this->from_dolar_to_curr =
            [
            'Germany' => 0.5,
            'England' => 1.5,
            'Soviet_Union' => 0.2,
            'Switzerland' => 1.0
            ];
    }

    public function convert($amount, $country)
    {
        $converted = $amount * $this->from_dolar_to_curr[$country];
        return $converted;
    }
}
