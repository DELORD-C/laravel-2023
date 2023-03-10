<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    public function own(User $user, Post $post)
    {
        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('You can only do this on your own posts.');
    }
}
