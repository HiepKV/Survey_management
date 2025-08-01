<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns';
    protected $fillable = [
      'title',
      'send_method',
      'send_date',
      'end_date',
      'status',
      'company_id',
      'created_by'
    ];
    protected $casts = [
        'send_date' => 'datetime:Y-m-d\TH:i:s',
        'end_date' => 'datetime:Y-m-d\TH:i:s',
        'created_at' => 'datetime:Y-m-d\TH:i:s',
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function forms(){
        return $this->hasOne(Form::class);
    }
    public function recipients(){
        return $this->hasMany(Recipient::class);
    }
    public function formAnswers()
    {
        return $this->hasManyThrough(
            FormAnswer::class,
            Recipient::class,
            'campaign_id',
            'recipient_id',
            'id',
            'id'
        );
    }
}

