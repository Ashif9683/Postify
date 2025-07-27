<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'image',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getShortContentAttribute()
    {
        return Str::limit(strip_tags($this->content), 100);
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('F d, Y'); 
    }


}
