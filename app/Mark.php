<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $guarded = [];
    public function User()
    {
        return $this->belongsTo('App\User', 'student_id','id');
    }
    public function assessment()
    {
    return $this->belongsTo(Assessment::class, 'assessment_id');
    }
}
