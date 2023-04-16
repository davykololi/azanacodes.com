<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\User;
use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    { 
        /* define an admin user role */
        Gate::define('isAdmin',function(User $user){
            return $user->role == UserRoleEnum::Admin;
        });

        /* define an editor user role */
        Gate::define('isEditor',function(User $user){
            return $user->role == UserRoleEnum::Editor;
        });

        /* define an admin user role */
        Gate::define('isAuthor',function(User $user){
            return $user->role == UserRoleEnum::Author;
        });

        /* define an admin user role */
        Gate::define('isVisitor',function(User $user){
            return $user->role == UserRoleEnum::Visitor;
        });

        Gate::define('create-article', function (User $user, Article $article) {
            return $user->id === $article->user_id;
        });

        Gate::define('edit-article', function (User $user) {
            return $user->role === UserRoleEnum::Editor;
        });
    }
}
