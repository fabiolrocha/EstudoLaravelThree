<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\User;

class Client extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'contact_user_id',
        'email',
        'address',
        'status',
    ];

    public function contactUser()
    {
        return $this->belongsTo(User::class, 'contact_user_id');
    }

    protected function createdAt()
    {
        return Attribute::make(
            get: fn($value) => $value->format('d/m/Y H:i')
        );
    }

    protected function name()
    {
        return Attribute::make(
            set: fn($value) => ucwords($value)
        );
    }
}
