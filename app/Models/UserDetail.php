<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'user_details';

    protected $casts = [
        'work_experience' => 'array',
        'organization' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected $fillable = ['user_id', 'first_name', 'last_name', 'email', 'work_experience', 'organization'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
