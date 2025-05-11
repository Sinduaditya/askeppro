<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OutcomeCriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'outcome_id',
        'name',
        'value_direction',
        'description',
    ];

    /**
     * Get the outcome that owns the criteria.
     */
    public function outcome(): BelongsTo
    {
        return $this->belongsTo(Outcome::class);
    }
}
