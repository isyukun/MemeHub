<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

        protected $fillable = ['user_id', 'meme_id'];
    
        public function user() {
            return $this->belongsTo(User::class);
        }
    
        public function meme() {
            return $this->belongsTo(Meme::class);
        }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function isLikedByAuthUser() {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
}
