<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'completed',
        'ip_address'
    ];

    protected $casts = [
        'completed' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($todo) {
            $todo->ip_address = request()->ip();
        });

        static::addGlobalScope('ip_address', function ($builder) {
            $builder->where('ip_address', request()->ip());
        });

    }

}
