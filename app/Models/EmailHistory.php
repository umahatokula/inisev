<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailHistory extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'subscription_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
