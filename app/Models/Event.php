<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function($event) {
            $numberOfDays = 90;
            for ($i=0; $i<=6; $i++) {
//                dump(Carbon::parse($event->created_at)->addDays($i)->format('l'));
//                dump($event->day);
                if (Carbon::parse($event->created_at)->addDays($i)->format('l') === $event->day) {
                    for ($j=0; $j<=($numberOfDays-1) - $i; $j+=7) {
                        Schedule::create([
                            'user_id' => auth()->id(),
                            'event_id' => $event->id,
                            'date' => Carbon::parse($event->created_at)->addDays($j + $i),
                            'startTime' => $event->startTime,
                            'endTime' => $event->endTime
                        ]);
                    }
                }
            }
        });
    }
}
