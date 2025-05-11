<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OutcomeStandard extends Model
{
    use HasFactory;

    protected $table = 'outcome_standards';

    protected $fillable = [
        'name',
        'diagnosis_id',
        'code',
        'order',
        'expectation',
    ];

    /**
     * Get the diagnosis that owns the outcome standard.
     */
    public function diagnosis(): BelongsTo
    {
        return $this->belongsTo(Diagnosis::class);
    }

    /**
     * Get the criteria for this outcome standard.
     */
    public function criteria(): HasMany
    {
        return $this->hasMany(OutcomeCriteria::class, 'outcome_id');
    }
}
