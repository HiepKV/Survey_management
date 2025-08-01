<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormAnswer extends Model
{
    protected $table = 'form_answers';
    protected $fillable = [
        'form_id',
        'question_id',
        'answer',
        'answered_at',
        'recipient_id'
    ];
    public function question(){
        return $this->belongsTo(FormQuestion::class, 'question_id');
    }
    public function recipient(){
        return $this->belongsTo(Recipient::class);
    }
}
