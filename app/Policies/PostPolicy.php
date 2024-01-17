<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    /*
    public function view(User $user, Post $post)
    {
        if ($user->admin == 0) {
            return $user->id == $post->user_id;
        }
        return true;
    }
*/
    /*
    public function create(User $user, Post $post)
    {
        if ($user->admin == false) {
            return $user->id == $post->user_id;
        }
        return true;
    }
    */
    public function edit(User $user, Post $post)
    {
        if ($user->admin == false) {
            //dd($user);
            return $user->id == $post->user_id;
        }
        return true;
    }

    public function destroy(User $user, Post $post)
    {
        //dd($post);
        if ($user->admin == false) {
            return $user->id == $post->user_id;
        }
        return true;
    }

    public function update(User $user, Post $post)
    {
        if ($user->admin == false) {
            return $user->id == $post->user_id;
        }
        return true;
    }
    /*
    public function create(User $user)
    {
        return Response::deny('NON SEI AUTO');
    }
    
    */
}
