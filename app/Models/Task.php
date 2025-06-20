<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    // relathionships
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function severity(): BelongsTo
    {
        return $this->belongsTo(Severity::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
