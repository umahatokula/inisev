<?php

namespace App\Models;

use App\Models\EmailHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['website_id', 'title', 'description'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function emailHistories()
    {
        return $this->hasMany(EmailHistory::class);
    }
}
