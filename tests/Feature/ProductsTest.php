<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function unauthorized_user_can_not_create_product()
    {
        // $this->withoutExceptionHandling();

        $product = $this->product('make', true);
        $this->post('/products', $product->toArray())->assertStatus(403);

        $this->user();

        $userProduct = $this->product('make');
        $this->post('/products', $userProduct->toArray())->assertStatus(403);
    }

    /** @test **/
    public function the_admin_can_create_a_product()
    {
        $this->withoutExceptionHandling();
        $this->admin();

        $product = $this->product('make');
        $this->post('/products', $product->toArray())->assertStatus(200);
    }

    /** @test **/
    public function unauthorised_user_can_not_update_product()
    {
        // $this->withoutExceptionHandling();
        $product = $this->product('create', true);
        $data    = [
            'name'        => 'new name',
            'price'       => 2000,
            'description' => 'new Description',
            'image_url'   => 'new image url',
        ];

        $this->patchJson('products/' . $product->id, $data)->assertStatus(403);

        $this->user();
        $userProduct = $this->product('create');
        $this->patchJson('products/' . $userProduct->id, $data)->assertStatus(403);
    }

    /** @test **/
    public function the_admin_can_update_the_product()
    {
        $this->withoutExceptionHandling();
        $this->admin();
        $product = $this->product('create');

        $data = [
            'name'        => 'new name',
            'price'       => 2000,
            'description' => 'new Description',
            'image_url'   => 'new image url',
        ];

        $this->patchJson('products/' . $product->id, $data)->assertStatus(200);
        $this->assertDatabaseHas('products', ['name' => $data['name']]);
    }


    /** @test **/
    public function unauthorized_user_can_not_delete_product()
    {
        $product = $this->product('create', true);
        $this->delete('products/'.$product->id)->assertStatus(403);
    }

    /** @test **/
    public function the_admin_can_delete_product()
    {
        $this->admin();
        $product = $this->product('create');

        $this->delete('products/'.$product->id)->assertStatus(200);

        $this->assertDatabaseMissing('products', ['name' => $product->name]);
    }



    protected function user()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
    }

    protected function admin()
    {
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
    }

    /**
     * @return mixed
     */
    protected function product($action, $guest = null)
    {
        return $product = $guest ? factory(Product::class)->$action() :
        factory(Product::class)->$action(['user_id' => auth()->id()]);
    }
}
