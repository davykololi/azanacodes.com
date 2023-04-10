<?php

namespace App\Models;

use Cache;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Profile;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use Lab404\Impersonate\Models\Impersonate;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasGravatar;
use App\Casts\TimestampsCast;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements BannableContract
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword, Bannable, Sluggable, Impersonate, HasGravatar;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name','email','role','banned_at','password','provider','provider_id','slug'];
    protected $with = ['articles','comments','profile'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'name'=>TimestampsCast::class,
        'role' => UserRoleEnum::class
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function isAdmin()
    {
        return $this->role === UserRoleEnum::Admin;
    }

    public function isEditor()
    {
        return $this->role === UserRoleEnum::Editor;
    }

    public function isAuthor()
    {
        return $this->role === UserRoleEnum::Author;
    }

    public function isVisitor()
    {
        return $this->role === UserRoleEnum::Visitor;
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class,'user_id','id');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class,'user_id','id');
    }

    public function comments(): HasManyThrough
    {
        return $this->hasManyThrough(Comment::class,Article::class,'user_id','article_id','id');
    }

    public function path()
    {
        return route('article-author.articles', $this->slug);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->id);
    }

    public function scopeEagerLoaded($query)
    {
        return $query->with('articles','comments','profile');
    }
}
