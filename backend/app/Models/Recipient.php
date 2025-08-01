<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $table = 'recipients';
    protected $fillable = [
        'email',
        'name',
        'phone',
        'campaign_id',
        'status',
        'responded_at'
    ];
    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }
    public function answers(){
        return $this->hasMany(FormAnswer::class);
    }
    public function memos(){
        return $this->hasMany(Memo::class);
    }
}
