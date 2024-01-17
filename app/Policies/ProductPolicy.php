<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    /*
    public function view(User $user, Product $Product)
    {
        if ($user->admin == 0) {
            return $user->id == $Product->user_id;
        }
        return true;
    }
*/
    /*
    public function create(User $user, Product $Product)
    {
        if ($user->admin == false) {
            return $user->id == $Product->user_id;
        }
        return true;
    }
    */

    public function admin(User $user)
    {
        //dd($Product);
        if ($user->admin == false) {
            //dd($user);
            return false;
        }
        return true;
    }

    public function edit(User $user, Product $product)
    {
        //dd($user);
        if ($user->admin == false) {
            //dd($user);
            return $user->id == $product->user_id;
        }
        return true;
    }

    public function destroy(User $user, Product $product)
    {
        //dd($Product);
        if ($user->admin == false) {
            return $user->id == $product->user_id;
        }
        return true;
    }

    public function update(User $user, Product $product)
    {
        if ($user->admin == false) {
            return $user->id == $product->user_id;
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
