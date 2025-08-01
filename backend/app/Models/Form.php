<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'forms';
    protected $fillable = [
        'title',
        'description',
        'status',
        'hero_image',
        'favicon',
        'campaign_id'
    ];
    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }
    public function questions(){
        return $this->hasMany(FormQuestion::class);
    }
}
