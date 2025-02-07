<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleFile extends Model
{
    use HasFactory;
    protected $fillable = ['sale_id', 'file_path'];
    public function sale()
{
    return $this->belongsTo(Sale::class, 'sale_id');
}
}
