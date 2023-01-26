<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function emailReplies()
    {
        return $this->hasMany(EmailReply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'recipient', 'email');
    }

    protected function attachFiles(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value)
        );
    }
}
