<?php

namespace App\Traits;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;

trait DatetimeTraits
{
    
    public function getCreatedAtAttribute($value){
        try {
             return (new Carbon($value))->setTimezone(new CarbonTimeZone('asia/kolkata'))->format('Y-m-d h:i A');
           
        } catch (\Exception $e) {
           return 'Invalid DateTime Exception: '.$e->getMessage();
        }        
    }
    public function convertToTimeZone($value){
        try {
            return (new Carbon($value))->setTimezone(new CarbonTimeZone('asia/kolkata'))->format('Y-m-d h:i A');
        } catch (\Exception $e) {
            return 'Invalid DateTime Exception: '.$e->getMessage();
        }        
    }
}
