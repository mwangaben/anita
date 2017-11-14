<?php

namespace App\Policies;

use App\User;
use App\HomeSection;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomeSectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the homeSection.
     *
     * @param  \App\User  $user
     * @param  \App\HomeSection  $homeSection
     * @return mixed
     */
    public function view(User $user, HomeSection $homeSection)
    {
        //
    }

    /**
     * Determine whether the user can create homeSections.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the homeSection.
     *
     * @param  \App\User  $user
     * @param  \App\HomeSection  $homeSection
     * @return mixed
     */
    public function update(User $user, HomeSection $homesection)
    {  
        // dd($homesection->user_id);
        return $user->id == $homesection->user_id  && $user->role == 'admin'; 
    }

    /**
     * Determine whether the user can delete the homeSection.
     *
     * @param  \App\User  $user
     * @param  \App\HomeSection  $homeSection
     * @return mixed
     */
    public function delete(User $user, HomeSection $homeSection)
    {
        //
    }
}
