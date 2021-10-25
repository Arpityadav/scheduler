<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    public function index()
    {
//        dd(auth()->user()->schedules()->with('event:id,title'));
        $event = auth()->user()->events;

        return $event->each->load('schedules');
    }

    public function show(Schedule $schedule)
    {
        $schedule = $schedule->load('event');

        return inertia('Schedule/Show', compact('schedule'));
    }
}
