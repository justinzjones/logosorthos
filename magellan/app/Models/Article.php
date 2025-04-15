<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'category_name',
        'date_created'
    ];

    protected $casts = [
        'date_created' => 'datetime'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_name', 'name');
    }
}
