<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DatetimeTraits;

class ShortUrl extends Model
{
    use DatetimeTraits;
    protected $fillable = [
        'original_url',
        'short_code',
        'user_id',
        'hits',
        'status'
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
