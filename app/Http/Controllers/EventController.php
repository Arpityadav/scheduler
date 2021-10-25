<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Rules\NameOfAWeekday;
use App\Providers\RouteServiceProvider;

class EventController extends Controller
{
    public function create()
    {
        return inertia('Event/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:2', 'max:100'],
            'description' => ['required', 'min:2', 'max:1000'],
            'startTime' => ['required', 'date_format:H:i'],
            'endTime' => ['required', 'date_format:H:i', 'after:startTime'],
            'day' => ['required', new NameOfAWeekday()],
        ]);

        Event::create($validatedData + ['user_id' => auth()->id()]);

        return redirect(RouteServiceProvider::HOME);
    }
}
