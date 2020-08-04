<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $guarded = [];
    public function class()
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

}
