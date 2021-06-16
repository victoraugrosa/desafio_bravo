<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['initials', 'description', 'money_backing'];

    public static function updateCurrency($id, $data)
    {
        $data_updated = array_filter($data);

        $currency_updated = Currency::where('id', $id)->update($data_updated);
        
        $currency = Currency::find($id);

        return $currency;
    }

    public static function createCurrency($data)
    {

        $currency_created = Currency::create($data);
        
        return $currency_created;
    }

    public static function getCurrencyByInitials($initials)
    {
        $currency = self::where('initials', $initials)->whereNotNull('money_backing')->first();

        return isset($currency) ? $currency->money_backing : null;
    }

}
