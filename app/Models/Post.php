<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'body',
        'image',
        'user_id'
    ];

    public function imageUrl(): Attribute
    {
        return Attribute::get(fn() => $this->image ? Storage::url($this->image) : null);
    }
}
