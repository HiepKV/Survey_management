<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = [
        'name',
        'contact_name',
        'phone',
        'email',
        'created_by'
    ];
    public function users(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function campaigns(){
        return $this->hasMany(Campaign::class);
    }
}
