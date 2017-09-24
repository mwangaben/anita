<?php

namespace Tests\Feature;

use App\Event;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventsTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function unauthorized_user_can_not_create_an_event()
    {
        $event = factory(Event::class)->make();
        $this->postJson('/events', $event->toArray())->assertStatus(403);

        $this->normalUser();

        $event = $this->event('make');

        $this->post('events', $event->toArray())->assertStatus(403);
    }

    /** @test **/
    public function it_anuthorized_user_can_not_update_an_event()
    {
        // the Guest attempt
        $event = $this->event('create', true);
        $data  = [
            'title'         => ' new title',
            'body'          => 'new Body',
            'location'      => 'new location',
            'date_of_event' => Carbon::now(),

        ];
        $this->patchJson('events/' . $event->id, $data)->assertStatus(403);


        //The signed in user attempt
        $this->normalUser();
        $userEvent = $this->event('create');

        $this->patchJson('events/'.$userEvent->id, $data)->assertStatus(403);
    }

    /** @test **/
    public function unauthorized_user_can_not_delete_an_event()
    {
        $event = $this->event('create', true);

        $this->delete('events/' . $event->id)->assertStatus(403);

        $this->normalUser();
        $userEvent = $this->event('create');

        $this->delete('events/' . $userEvent->id)->assertStatus(403);
    }

    /** @test **/
    public function the_admin_can_create_an_event()
    {
        $this->admin();

        $event = $this->event('make');

        $this->post('events', $event->toArray())
            ->assertStatus(200);

        $this->assertDatabaseHas('events', ['title' => $event->title]);
    }

    /** @test **/
    public function the_admin_can_update_created_event()
    {
        $this->admin();

        $event  = $this->event('create');
        $event1 = factory(Event::class)->create(['title' => 'Benny']);

        $update = [
            'title'         => 'Anita',
            'body'          => 'body',
            'location'      => 'location',
            'date_of_event' => Carbon::now(),
        ];

        $this->patch('events/' . $event->id, $update)->assertStatus(200);

        $this->assertDatabaseHas('events', ['title' => $update['title']]);
        $this->assertDatabaseHas('events', ['title' => 'Benny']);
    }

    /** @test **/
    public function the_admin_can_delete_an_event()
    {
        $this->admin();
        $event = $this->event('create');

        $this->delete('events/' . $event->id)->assertStatus(200);

        $this->assertDatabaseMissing('events', ['title' => $event->title]);
    }


    /** @test **/
    public function it_shows_upcoming_events_if_any()
    {
        $this->admin();
  
        $tomorrow = ['date_of_event' => Carbon::tomorrow()];
        $future = factory(Event::class, 3)->create($tomorrow);
        
        $this->assertEquals(3, count(Event::upcomingEvents()));
    }

    /** @test **/
    public function it_shows_events_which_are_currently_happening()
    {
        $now = ['date_of_event' => Carbon::now()];
        $current = factory(Event::class, 2)->create($now);
        
        $this->assertEquals(2, count(Event::happeningNow()));
    }

    /** @test **/
    public function it_shows_events_which_happened_in_the_past()
    {
        $yesterday = ['date_of_event' => Carbon::yesterday()];
        $past= factory(Event::class, 1)->create($yesterday);
               
        $this->assertEquals(1, count(Event::pastEvents()));
    }


    /**
     *
     */
    protected function admin()
    {
        $admin = factory(User::class)->states('admin')->create();
        $this->ActingAs($admin);
    }

    /**
     * @return mixed
     */
    protected function event($action, $guest = null)
    {
        return $event = $guest ?
        factory(Event::class)->$action() :
        factory(Event::class)->$action(['user_id' => auth()->id()]);
    }

    /**
     *
     */
    protected function normalUser()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
    }
}
