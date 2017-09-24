<?php

namespace Tests\Feature;

use App\User;
use App\About;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function it_admin_can_update_about_page()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin);

        $content =  factory(About::class)->create();
        

        $this->assertDatabaseHas('users', ['name' => $admin->name]);
        $data = ['quote' => 'be nice to me', 'title' => 'new Title', 'body' => 'Hello'];
        

        $endpoint = 'about/'.$content->id;
        $this->patch($endpoint, $data)
             ->assertStatus(200);

        $this->assertDatabaseHas('abouts', [
             'title' => $data['title']

         ]);
    }
}
