<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;


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
        'assigned_user_id',
        'description',
        'deadline',
        'status',
        'project_id',
    ];

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function scopeStatus($query)
    {
        return $query->where('status', true);
    }

    protected function createdAt()
    {
        return Attribute::make(
            get: fn($value) => $value ? $value->format('d/m/Y H:i') : null,
        );
    }
}
