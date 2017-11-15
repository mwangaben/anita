<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
	use RefreshDatabase;

      /** @test **/ 
	function it_checks_if_is_a_normal_user()
	{
        $user = factory(User::class)->create();

        $this->assertFalse($user->admin());		
	}

	 
     /** @test **/ 
	function it_checks_if_is_an_admin_user()
	{
        $admin = factory(User::class)->states('admin')->create();

        $this->assertTrue($admin->admin());		
	}
}
