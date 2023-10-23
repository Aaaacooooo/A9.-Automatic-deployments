<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'writer_id'
    ];
    protected $table = 'articles';

    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
}
