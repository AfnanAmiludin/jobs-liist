<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    use HasFactory;
    protected $table = 'categori';

    protected $fillable = [
        'name_categori',
        'jobes_id'
    ];

    public function jobs()
    {
        return $this->belongsTo(Jobs::class);
    }
}
