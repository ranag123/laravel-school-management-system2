<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ptm extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'parent_id','id');
    }
}
