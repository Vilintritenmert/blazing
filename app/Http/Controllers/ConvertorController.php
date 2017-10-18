<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConvertRequest;
use App\Models\Currency;
use View;

class ConvertorController extends Controller
{
    public function show_page(Currency $currency)
    {
        return View::make('convertor.index', array(
            'currency_list' => array_keys($currency->list_of_currency()),
            'histories' => $currency->history()
        ));
    }

    public function convert(ConvertRequest $request, Currency $currency)
    {
        $currency->convert((float)$request->amount, $request->from, $request->to);

        return response()->json([
            'history' => $currency->history()
        ]);
    }
}
