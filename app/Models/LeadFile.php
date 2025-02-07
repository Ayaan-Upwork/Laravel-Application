<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadFile extends Model
{
    use HasFactory;
    protected $fillable = ['lead_id', 'file_path'];

public function lead()
{
    return $this->belongsTo(Lead::class, 'lead_id');
}
}
