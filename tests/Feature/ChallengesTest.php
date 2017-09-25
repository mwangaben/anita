<?php

namespace Tests\Feature;

use App\Challenge;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChallengesTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function unauthorized_user_can_not_create_a_challenge()
    {
        // $this->withoutExceptionHandling();

        $challenge = $this->challenge('make', true);
        $this->post('/challenges', $challenge->toArray())->assertStatus(403);

        $this->user();
        $userChallenge = $this->challenge('make');

        $this->post('/challenges', $challenge->toArray())->assertStatus(403);
    }

    /** @test **/
    public function the_admin_can_create_a_challenge()
    {
        // $this->withoutExceptionHandling();
        $this->admin();
        $challenge = $this->challenge('make');

        $this->post('/challenges', $challenge->toArray())->assertStatus(200);
        $this->assertDatabaseHas('challenges', ['name' => $challenge->name]);
    }

    /** @test **/
    public function it_unauthorised_user_can_not_update_challenge()
    {
        $challenge = $this->challenge('create', true);
        $newData   = [
            'name'        => 'new name',
            'description' => 'new description',
            'image_url'   => 'new image_url',
        ];

        $this->patchJson('challenges/' . $challenge->id, $newData)->assertStatus(403);

        $this->user();
        $this->challenge('create');

        $this->patchJson('challenges/' . $challenge->id, $newData)->assertStatus(403);
    }

    /** @test **/
    public function the_admin_can_update_challenge()
    {
        $this->withoutExceptionHandling();
        $this->admin();
        $challenge = $this->challenge('create');

        $newData = [
            'name'        => 'new name',
            'description' => 'new description',
            'image_url'   => 'new image_url',
        ];

        $this->patchJson('challenges/' . $challenge->id, $newData)->assertStatus(200);

    }

    /** @test **/
    public function unauthorized_user_can_not_delete_a_challenge()
    {
        $challenge = $this->challenge('create', true);
        $this->delete('challenges/' . $challenge->id)->assertStatus(403);

        $this->user();
        $challenge = $this->challenge('create');
        $this->delete('challenges/' . $challenge->id)->assertStatus(403);
    }

    /** @test **/
    public function the_admin_can_delete_a_challenge()
    {
        $this->admin();
        $challenge = $this->challenge('create');
        $this->delete('challenges/' . $challenge->id)->assertStatus(200);
    }

    /**
     * @param $action
     */
    protected function challenge($action, $guest = null)
    {
        return $challenge = $guest ?
        factory(Challenge::class)->$action() :
        factory(Challenge::class)->$action(['user_id' => auth()->id()]);
    }

    /**
     * @param $action
     */
    protected function user()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
    }

    /**
     * @param $action
     */
    protected function admin()
    {
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
    }
}
