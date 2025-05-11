<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Outcome extends Model
{
    use HasFactory;

    protected $fillable = [
        'askep_case_id',
        'diagnosis_id', // Tambahkan ini
        'name',
        'initial_value',
        'target_value',
        'final_value', // Tambahkan ini juga
        'outcome_standard_id',
    ];

    public function outcomeStandard()
    {
        return $this->belongsTo(OutcomeStandard::class);
    }

    /**
     * Get the askep case that owns the outcome.
     */
    public function askepCase(): BelongsTo
    {
        return $this->belongsTo(AskepCase::class, 'askep_case_id');
    }

    public function getNameAttribute()
    {
        return $this->outcomeStandard ? $this->outcomeStandard->name : null;
    }

    public function diagnosis(): BelongsTo
    {
        return $this->belongsTo(Diagnosis::class);
    }
}
