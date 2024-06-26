<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'track_id',
        'comment',
    ];
    public function track() {
        return $this->belongsTo(Track::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
