<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AskepCase extends Model
{
    use HasFactory;

    // Konstanta untuk status
    const STATUS_IN_PROGRESS = 'proses';
    const STATUS_COMPLETED = 'selesai';

    protected $fillable = ['patient_id', 'diagnosis_id', 'status', 'cause'];

    /**
     * Get the patient that owns the askep case.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the symptoms for the askep case.
     */
    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class, 'case_symptoms');
    }

    /**
     * Get the outcomes for the askep case.
     */
    public function outcomes(): HasMany
    {
        return $this->hasMany(Outcome::class, 'askep_case_id');
    }

    /**
     * Get the implementations for the askep case.
     */
    public function implementations(): HasMany
    {
        return $this->hasMany(CaseImplementation::class, 'askep_case_id');
    }

    /**
     * Get the evaluation for the askep case.
     */
    public function evaluation(): HasOne
    {
        return $this->hasOne(Evaluation::class, 'askep_case_id');
    }

    /**
     * Get the diagnosis for the askep case.
     */

    /**
     * Check if the case is in progress.
     */
    public function isInProgress(): bool
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }

    /**
     * Check if the case is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    // public function diagnoses(): BelongsToMany
    // {
    //     return $this->belongsToMany(Diagnosis::class, 'case_diagnoses', 'askep_case_id', 'diagnosis_id')->withPivot('is_primary')->withTimestamps();
    // }

    /**
     * Get the primary diagnosis for the case.
     */
    public function primaryDiagnosis(): BelongsTo
    {
        // Keep the existing relationship for backward compatibility
        // but modify the implementation
        return $this->belongsTo(Diagnosis::class, 'diagnosis_id');
    }

    /**
     * Get all secondary diagnoses for the case.
     */
    public function secondaryDiagnoses(): BelongsToMany
    {
        return $this->belongsToMany(Diagnosis::class, 'case_diagnoses', 'askep_case_id', 'diagnosis_id')->wherePivot('is_primary', false)->withTimestamps();
    }

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class, 'diagnosis_id');
    }

    /**
     * Relasi many-to-many dengan diagnosis
     */
    public function diagnoses()
    {
        return $this->belongsToMany(Diagnosis::class, 'case_diagnoses', 'askep_case_id', 'diagnosis_id')->withPivot('is_primary')->withTimestamps();
    }
}
