<?php

namespace App\Models;

use Carbon\Factory;
use Database\Factories\LocationImageFactory;
use Faker\Factory as FakerFactory;
use Illuminate\Console\View\Components\Factory as ComponentsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LocationImage extends Model
{
    use HasFactory;
    protected $fillable = [

        
        'image',

    ];
    

    public function locations(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

}
