<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{

    use HasFactory;
    use SoftDeletes;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    protected $fillable = [
        'name',
        'description',
        'deadline',
        'status',
        'client_id',
    ];

     protected function createdAt()
    {
        return Attribute::make(
            get: fn($value) => $value->format('d/m/Y H:i')
        );
    }
}
