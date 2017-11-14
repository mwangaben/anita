<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Event'   => 'App\Policies\EventPolicy',
        'App\Product' => 'App\Policies\ProductPolicy',
        'App\Challenge' => 'App\Policies\ChallengePolicy',
        'App\About' => 'App\Policies\AboutPolicy',
        'App\HomeSection' => 'App\Policies\HomeSectionPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
