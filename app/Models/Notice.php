<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'priority', 'user_id'];

    // 🆕 ADDED: Relationship to track which users have read this notice
    public function users()
    {
        return $this->belongsToMany(User::class, 'notice_user')->withTimestamps();
    }
}