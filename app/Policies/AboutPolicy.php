<?php

namespace App\Policies;

use App\User;
use App\About;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the about.
     *
     * @param  \App\User  $user
     * @param  \App\About  $about
     * @return mixed
     */
    public function view(User $user, About $about)
    {
        //
    }

    /**
     * Determine whether the user can create abouts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the about.
     *
     * @param  \App\User  $user
     * @param  \App\About  $about
     * @return mixed
     */
    public function update(User $user, About $about)
    {
        return $user->id == $about->user_id && $user->role == 'admin';
    }

    /**
     * Determine whether the user can delete the about.
     *
     * @param  \App\User  $user
     * @param  \App\About  $about
     * @return mixed
     */
    public function delete(User $user, About $about)
    {
        //
    }
}
