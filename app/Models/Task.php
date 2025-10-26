<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Task extends Model
{

    use HasFactory;
    use SoftDeletes;
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status',
        'project_id',
    ];

    protected function createdAt()
    {
        return Attribute::make(
            get: fn($value) => $value ? $value->format('d/m/Y H:i') : null,
        );
    }
}
