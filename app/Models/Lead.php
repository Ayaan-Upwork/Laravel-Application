<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id' ,'clouser','name', 'business_name', 'phone', 'address', 'zip', 'state', 'country', 'comment', 'status'
    ];
    public function leadFiles()
{
    return $this->hasMany(LeadFile::class, 'lead_id');
}
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
public function clousers()
{
    return $this->belongsTo(User::class, 'clouser');
}
}
