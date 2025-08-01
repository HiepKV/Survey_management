<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormQuestion extends Model
{
    protected $table = 'form_questions';
    protected $fillable = [
        'form_id',
        'type',
        'label',
        'required',
        'order'
    ];
    public function form(){
        return $this->belongsTo(Form::class);
    }
    public function answers(){
        return $this->hasMany(FormAnswer::class);
    }
}
