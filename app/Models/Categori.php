<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_categori'
    ];

    public function jobs()
    {
        return $this->belongsTo(Jobs::class);
    }
}
