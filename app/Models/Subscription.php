<?php

namespace App\Models;

use App\Models\EmailHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['website_id', 'user_id'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function emailLogs()
    {
        return $this->hasMany(EmailHistory::class);
    }
}
