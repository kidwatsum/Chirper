<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    //
    protected $fillable = [
        'message',
    ];

    public function user(): belongsTo {

        return $this->belongsTo(User::class);

    }
}
