<?php

namespace App\Models;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CommunityLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
        'channel_id',
        'link',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
}
