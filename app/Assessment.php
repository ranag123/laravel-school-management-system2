<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $guarded = [];
    public function class()
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }
    public function subjects()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }
    public function marks()
    {
        return $this->hasMany(Mark::class,'assessment_id');
    }

}
