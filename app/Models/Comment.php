<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $fillable = [
        'from',
        'text',
        'show',
    ];

    protected function casts(): array
    {
        return [
            'show' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function scopeShown(Builder $query): void
    {
        // Your database schema defines 'show' as a boolean,
        // which typically stores 1 (true) or 0 (false).
        $query->where('show', true);
    }
}
