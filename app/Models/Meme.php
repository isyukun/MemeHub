<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    use HasFactory;

    // Tambahkan baris ini
    protected $fillable = ['user_id', 'title', 'category', 'image_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Relasi likes yang tadi kita bahas juga bisa ditaruh di sini
    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function isLikedByAuthUser() {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter($query, array $filters)
    {
        // Filter pencarian berdasarkan judul (Search)
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        });

        // Filter berdasarkan kategori
        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->where('category', $category);
        });
    }
}