<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyMessage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function relation_to_property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

    public function relation_to_user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
