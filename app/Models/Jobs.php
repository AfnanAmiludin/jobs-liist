<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_name',
        'company',
        'rate',
        'sallary',
    ];

    public function categories()
    {
        return $this->hasMany(Categori::class, 'jobes_id', 'id');
    }
}
