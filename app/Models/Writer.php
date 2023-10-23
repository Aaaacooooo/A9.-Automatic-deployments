<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    protected $table = 'writers';

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
