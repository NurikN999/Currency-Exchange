<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currency_history';

    protected $fillable = [
        "USD",
        "EUR",
        "GBP",
        "RUB",
        "CNH",
    ];
}
