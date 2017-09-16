<?php

namespace Tests\Feature;

use App\ContactUs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactUsTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_a_visitor_can_send_us_a_message()
    {
        $user = factory(ContactUs::class)->make();

        $this->post('/messages', $user->toArray())
             ->assertStatus(200);

        $this->assertDatabaseHas('contact_uses', [
            'name'    => $user->name,
            'phone'   => $user->phone,
            'email'   => $user->email,
            'message' => $user->message,
        ]);
    }

    /** @test **/
    public function a_name_field_can_not_be_blank()
    {
        $this->passValidation('name');
    }

    /** @test **/
    public function an_email_field_can_not_be_blank()
    {
        $this->passValidation('email');
    }

    /** @test **/
    public function a_phone_number_field_can_not_be_blank()
    {
        $this->passValidation('phone');
    }

      /** @test **/ 

    function it_the_message_field_can_not_be_blank()
    {
        $this->passValidation('message');
    }

    protected function passValidation($field)
    {
        $message = factory(ContactUs::class)->make([$field => null]);

        $this->post('/messages', $message->toArray())
            ->assertSessionHasErrors($field);
    }

}
