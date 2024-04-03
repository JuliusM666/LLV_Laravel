<?php

namespace App\Models;

use App\Events\LocationCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [

        'name',
        'description',
        

    ];
    protected $dispatchesEvents = [

        'created' => LocationCreated::class,

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function images(): HasMany{
        return $this->hasMany(LocationImage::class);
    }
}
