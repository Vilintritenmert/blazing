<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Currency extends Model
{
    public function list_of_currency()
    {
        return Cache::get('currencies');
    }

    public function convert($amount, $from, $to)
    {
        $currencies = $this->list_of_currency();
        $curs = $currencies[$to] / $currencies[$from];
        $result = $amount * $curs;

        $this->add_to_history($amount, $from, $to, $result);
    }

    private function round_num($num) 
    {
        return number_format((float)$num, 2, '.', '');
    }

    public function history()
    {
        return json_decode(session('history', '[]'), 1);
    }

    private function add_to_history($amount, $from, $to, $result)
    {
        $history = array_slice($this->history(), -4);

        $history[] = [
            'amount' => $this->round_num($amount),
            'from' => $from,
            'to' => $to,
            'result' => $this->round_num($result)
        ];
        
        session([
            'history' => json_encode($history)
        ]);
    }
}
