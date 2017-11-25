<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Determine whether the user can view the model.
     *
     * @param  \App\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function edit(User $user, User $model)
    {
        if (!auth()->user()->inCommittee() && auth()->id() != $model->id) {
            abort(404);
        }

        return $user->id == $model->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if (!auth()->user()->inCommittee() && auth()->id() != $model->id) {
            abort(404);
        }

        return $user->id == $model->id;
    }
}
