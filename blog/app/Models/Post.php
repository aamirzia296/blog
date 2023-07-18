<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}