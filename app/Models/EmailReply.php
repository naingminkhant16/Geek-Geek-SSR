<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailReply extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    protected function attachFiles(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value)
        );
    }
}
