<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaseImplementation extends Model
{
    use HasFactory;

    protected $fillable = ['askep_case_id', 'intervention_id', 'diagnosis_id', 'performed', 'notes', 'waktu'];

    /**
     * Get the askep case that owns the implementation.
     */
    public function askepCase(): BelongsTo
    {
        return $this->belongsTo(AskepCase::class, 'askep_case_id');
    }

    /**
     * Get the intervention that owns the implementation.
     */
    public function intervention(): BelongsTo
    {
        return $this->belongsTo(Intervention::class);
    }

    public function diagnosis(): BelongsTo
    {
        return $this->belongsTo(Diagnosis::class);
    }
}
