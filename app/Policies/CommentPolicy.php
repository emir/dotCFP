<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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
     * Determine whether the user can delete the talk.
     *
     * @param  \App\User $user
     * @param  \App\Comment $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->id == $comment->user_id;
    }
}
