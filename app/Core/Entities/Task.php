<?php

namespace App\Core\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'category_id',
        'project_id'
    ];

    /**
     * Releationships
     */

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
