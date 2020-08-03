<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $guarded = [];
    public function class()
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }
    public function students()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
