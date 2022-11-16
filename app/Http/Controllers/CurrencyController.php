<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{

    public function index()
    {

    }

    public function getHistory()
    {
        $history = [];
        $endDate = Carbon::now('+6');
        $result = DB::table('currency_history')
            ->selectRaw("*")
            ->where('created_at', '<', $endDate)
            ->get();
        foreach ($result as $res) {
            $history[$res->created_at] = $res;
        }
        return response()->json(
            [
                'history' => $history
            ]
        );
    }
}
