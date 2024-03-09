<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function relation_to_type()
    {
        return $this->belongsTo(PropertyType::class,'ptype_id','id');
    }
    public function relation_to_user()
    {
        return $this->belongsTo(User::class,'agent_id','id');
    }
}
