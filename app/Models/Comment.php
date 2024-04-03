<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [

        'comment',

    ];
  
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function getDate(){
        $dt = Carbon::now();
        $past    = Carbon::create($this->created_at);
        return $dt->diffForHumans($past);
    }
}