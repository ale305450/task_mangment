<?php

namespace App\Core\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id'
    ];

    /**
     * Releationships
     */
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
