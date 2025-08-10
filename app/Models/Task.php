<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'completed_at',
        'user_id',
        'category_id',
        'recurrence',
        'repeat_interval',
        'recurs_until',
        'is_recurring',
    ];
    protected $casts = [
        'due_date' => 'date',
        'completed_at' => 'datetime',
        'recurs_until' => 'datetime',
        'is_recurring' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}

