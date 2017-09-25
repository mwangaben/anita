<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChallengeProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function admin_can_associate_a_challenge_with()
    {
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);

        $challenge = factory(Challenge::class)->create(['user_id' => auth()->id()]);
        $product   = factory(Product::class)->create(['user_id' => auth()->id()]);

        
        
    }



}
