<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class Tag extends Model
{
    use HasFactory;
    protected $fillable = [

        'name',
      
      

    ];
    public function Location(): BelongsToMany
    {
        return $this->belongsToMany(Location::class);
    }
    public function getPopularity(){
        return round(DB::table('location_tag')->where('tag_id',$this->id)->count()/DB::table('location_tag')->count()*100);
    }
 
   
}
