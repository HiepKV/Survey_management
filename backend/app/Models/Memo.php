<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $table = 'memos';
    protected $fillable = [
        'user_id',
        'content',
    ];
    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
}
