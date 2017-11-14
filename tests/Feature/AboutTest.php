<?php

namespace Tests\Feature;

use App\About;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function admin_can_update_about_page()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin);

        $about = factory(About::class)->create(['user_id' => auth()->id()]);

        $data = [
            'quote' => 'be nice to me',
            'title' => 'new Title',
            'body'  => 'Hello'
        ];

        $this->patch('/about/' . $about->id, $data)->assertStatus(200);

        $this->assertDatabaseHas('abouts', [
            'title' => $data['title'],

        ]);
    }

    /** @test **/
    public function it_un_signed_in_user_can_not_update_the_about_page()
    {
        $about = factory(About::class)->create();
        $data  = [
            'quote' => 'be nice to me',
            'title' => 'new Title',
            'body'  => 'Hello',
        ];

        $this->patch('/about/' . $about->id, $data)->assertStatus(302);
    }

    /** @test **/
    public function it_normal_user_can_not_update_the_about_page()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $about = factory(About::class)->create(['user_id' => auth()->id()]);
        $data  = [
            'quote' => 'be nice to me',
            'title' => 'new Title',
            'body'  => 'Hello',
        ];

        $this->patch('/about/' . $about->id, $data)->assertStatus(403);

    }
}
