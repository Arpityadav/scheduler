<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchedulesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function when_an_event_is_created_it_creates_schedules_accordingly()
    {
        $user = User::factory()->create(['firstname' => 'Foo']);
        $this->actingAs($user)->withoutExceptionHandling();

        $event1 = Event::factory()->make(['user_id' => $user->id, 'created_at' => '2021-01-04 02:34:49', 'updated_at' => '2021-01-04 02:34:49', 'day' => 'Friday']);
//        dd($event);

        $this->post(route('event.store'), $event1->toArray());

        $this->assertDatabaseCount('events', 1);
        $this->assertDatabaseCount('schedules', 13);

        $event2 = Event::factory()->make(['user_id' => $user->id, 'created_at' => '2021-01-04 02:34:49', 'updated_at' => '2021-01-04 02:34:49', 'day' => 'Sunday']);
        $this->post(route('event.store'), $event2->toArray());

        $this->assertDatabaseCount('events', 2);
        $this->assertDatabaseCount('schedules', 25);

        $event3 = Event::factory()->make(['user_id' => $user->id, 'created_at' => '2021-01-04 02:34:49', 'updated_at' => '2021-01-04 02:34:49', 'day' => 'Monday']);

        $this->post(route('event.store'), $event3->toArray());

        $this->assertDatabaseCount('events', 3);
        $this->assertDatabaseCount('schedules', 38);

    }
}
