<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function upcomingEvents()
    {
        return self::select()->where('date_of_event', '>', Carbon::now())->get();
        // return count(self::select()->where('date_of_event'  Carbon::now()));
    }

    public static function pastEvents()
    {
        return self::select()->where('date_of_event', '<', Carbon::now())->get();
    }

    public static function happeningNow()
    {
        return self::select()->where('date_of_event', '=', Carbon::now())->get();
    }
}
