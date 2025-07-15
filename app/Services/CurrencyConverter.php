<?php

namespace App\Services;

class CurrencyConverter
{
    private $TO_IEEE_Rates = [];
    private $From_IEEE_Rates = [];

    public function __construct()
    {
        $this->TO_IEEE_Rates =
            [
            'Germany_Reichsmark' => 0.5,
            'England_Pound' => 1.5,
            'Soviet_Union_Ruble' => 0.2,
            'Switzerland_Franc' => 1.0
            ];

        foreach ($this->TO_IEEE_Rates as $currency => $rate)
        {
            $this->From_IEEE_Rates[$currency] = 1 / $rate;
        }
    }

    public function convert($amount, $fromCurrency, $toCurrency)
    {
        $Converted = ( $this->TO_IEEE_Rates[$fromCurrency] * $amount ) /* Convert to IEEE rate */ *  $this->From_IEEE_Rates[$toCurrency] /* convert to destination currency rate */ ;

        return $Converted;
    }
}
