<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable = ['number'];
    public $timestamps = false;

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
    public function series() 
    {
        return $this->belongsTo(Serie::class);
    }
    public function getEpisodesVisualized(): Collection
    {
        return $this->episodes->filter(function(Episode $episode){
            return $episode->visualized;
        });
    }
}
