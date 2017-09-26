<?php

namespace Tests\Feature;

use App\User;
use App\Product;
use App\Challenge;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChallengeProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function admin_can_associate_a_challenge_with_product()
    {
    	$this->withoutExceptionHandling();

        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);

        $challenge = factory(Challenge::class)->create(['user_id' => auth()->id()]);
        $product   = factory(Product::class)->create(['user_id' => auth()->id()]);


        $challenge2 = factory(Challenge::class)->create(['user_id' => auth()->id()]);
        $product2   = factory(Product::class)->create(['user_id' => auth()->id()]);

        $data = ['challenge' => $challenge->id, 'product' => $product->id];
        $data2 = ['challenge' => $challenge2->id, 'product' => $product2];
         
        $this->postJson('challengesproducts', $data)->assertStatus(200);
        $this->postJson('challengesproducts', $data2)->assertStatus(200);

        $this->assertDatabaseHas('challenge_product', [
            'challenge_id' => $challenge->id,
            'product_id'   => $product->id,
        ]);
        $this->assertDatabaseHas('challenge_product', [
            'challenge_id' => $challenge2->id,
            'product_id'   => $product2->id,
        ]);

        $this->postJson('challengesproducts', $data)->assertStatus(200);

        $this->assertDatabaseMissing('challenge_product', [
            'challenge_id' => $challenge->id,
            'product_id'   => $product->id,
        ]);

        $this->assertDatabaseHas('challenge_product', [
            'challenge_id' => $challenge2->id,
            'product_id'   => $product2->id,
        ]);



    }

}
