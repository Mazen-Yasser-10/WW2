<?php

namespace App\Services;

class CurrencyConverter
{
    private $from_dolar_to_curr = [];
    private $currency_symbols = [];
    
    public function __construct()
    {
        $this->from_dolar_to_curr =
            [
                'Germany' => 2.5,
                'England' => 0.25,
                'United Kingdom' => 0.25,
                'Soviet Union' => 5.3,
                'Switzerland' => 4.3
            ];
            
        $this->currency_symbols = [
                'Germany' => 'RM',
                'England' => '£',
                'United Kingdom' => '£',         
                'Soviet Union' => '₽',
                'Switzerland' => 'CHF'
            ];
    }

    public function convert($amount, $country)
    {
        $converted = $amount * $this->from_dolar_to_curr[$country];
        return $converted;
    }
    public function getCurrencySymbol($country)
    {
        $country = ucwords(strtolower($country));
        return $this->currency_symbols[$country] ?? '$';
    }
    
    public function convertWithSymbol($amount, $country)
    {
        $converted = $this->convert($amount, $country);
        $symbol = $this->getCurrencySymbol($country);
        
        if ($country === 'England' || $country === 'United Kingdom') {
            return $symbol . number_format($converted, 2);
        } else {
            return number_format($converted, 2) . ' ' . $symbol;
        }
    }
}
