<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Gate;
//use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //define ha due parametri 1 il nome della ability
        // e la seconda avra dentro l'istanza dello user
        // e un istanza d Post

        Gate::define('admin', function (User $user) {
            return $user->admin;
        });

        Gate::define('update-post', function (User $user, Post $post) {
            dd($user, $post);
            if ($user->admin == false) {
                return $user->id == $post->user_id;
            }
            return true;
        });

        Gate::define('destroy-post', function (User $user, Post $post) {
            dd($post);
            if ($user->admin == false) {
                return $user->id == $post->user_id;
            }
            return true;
        });

        Gate::define('edit-post', function (User $user, Post $post) {
            dd($user);
            if ($user->admin == false) {
                return $user->id == $post->user_id;
            }
            return true;
        });

        //oppure
        //Gate::define('update-post', [PostPolicy::class, 'update']);
        //

    }
}
