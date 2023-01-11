<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $primaryKey = 'id';
    protected $fillable = ['image','facebook_url','twitter_url','instagram_url','mobile_no','state','city','user_id','user_details'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
