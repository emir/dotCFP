<?php

namespace App\Policies;

use App\User;
use App\Talk;
use Illuminate\Auth\Access\HandlesAuthorization;

class TalkPolicy
{
    use HandlesAuthorization;

    /**
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->role == 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can edit the talk.
     *
     * @param  \App\User $user
     * @param  \App\Talk $talk
     * @return mixed
     */
    public function edit(User $user, Talk $talk)
    {
        return $user->id == $talk->user_id;
    }

    /**
     * Determine whether the user can update the talk.
     *
     * @param  \App\User $user
     * @param  \App\Talk $talk
     * @return mixed
     */
    public function update(User $user, Talk $talk)
    {
        return $user->id == $talk->user_id;
    }

    /**
     * Determine whether the user can delete the talk.
     *
     * @param  \App\User $user
     * @param  \App\Talk $talk
     * @return mixed
     */
    public function delete(User $user, Talk $talk)
    {
        return $user->id == $talk->user_id;
    }
}
