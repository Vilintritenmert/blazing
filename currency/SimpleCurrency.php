<?php

namespace Vilintritenmert;

class SimpleCurrency
{
    /**
    * Get List of currencies 
    */
    public function get() 
    {
        $api_url = 'http://api.fixer.io/latest?base=usd';
        $response = @file_get_contents($api_url);
        
        if(!$response) 
            throw new Exception('Problem with connection');
        
        $decoded_response = json_decode($response, true);
        
        if(!array_key_exists('rates', $decoded_response)) 
            throw new Exception('Wrong response');

        $currencies = $decoded_response['rates'];
        $currencies['USD']=(float)1;

        return $currencies;
    }
}
