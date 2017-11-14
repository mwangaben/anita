<?php

namespace Tests\Feature;

use App\HomeSection;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeSectionsTest extends TestCase
{

    use RefreshDatabase;

    /** @test **/
    public function it_display_the_home_section()
    {
        $this->get('/homesection')->assertStatus(200);
    }

    /** @test **/
    public function admin_can_update_the_home_section()
    {
        $this->withoutExceptionHandling();
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);

        $homeSection = factory(HomeSection::class)->create(['user_id' => auth()->id()]);

        $data = [
            'introlead'  => 'Intro Leading',
            'introhead'  => 'Intro Heading',
            'infoButton' => 'Info button',
        ];

        $this->patch('/homesection/' . $homeSection->id, $data)->assertStatus(200);

        $this->assertDatabaseHas('home_sections', [
            'user_id'    => $admin->id,
            'introlead'  => $data['introlead'],
            'introhead'  => $data['introhead'],
            'infoButton' => $data['infoButton'],

        ]);
    }

    /** @test **/
    public function it_un_signed_user_can_not_update_the_home_section()
    {
        $homesection = factory(HomeSection::class)->create();

        $data = [
            'introlead'  => 'The intro Leading Page',
            'introhead'  => 'The intro Heading Page',
            'infoButton' => 'The Info button',
        ];

        $this->patch('/homesection/' . $homesection->id, $data)->assertStatus(302);
    }


      /** @test **/ 
    function it_normal_user_can_not_update_the_home_section()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
                
        $homesection = factory(HomeSection::class)->create(['user_id' => auth()->id()]);

        $data = [
            'introlead'  => 'The intro Leading Page',
            'introhead'  => 'The intro Heading Page',
            'infoButton' => 'The Info button',
        ];

        $this->patch('/homesection/' . $homesection->id, $data)->assertStatus(403);
    }
}
