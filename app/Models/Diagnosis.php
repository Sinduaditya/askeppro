<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Diagnosis extends Model
{
    use HasFactory;

    protected $table = 'diagnosis';

    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    /**
     * Get all symptoms associated with the diagnosis.
     */
    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class, 'diagnosis_symptoms')
            ->withPivot('is_main')
            ->withTimestamps();
    }

    /**
     * Get main symptoms associated with the diagnosis.
     */
    public function mainSymptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class, 'diagnosis_symptoms')
            ->wherePivot('is_main', 1)
            ->withTimestamps();
    }

    /**
     * Get supporting symptoms associated with the diagnosis.
     */
    public function supportingSymptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class, 'diagnosis_symptoms')
            ->wherePivot('is_main', 0)
            ->withTimestamps();
    }

    /**
     * Get the etiologies associated with the diagnosis.
     */
    public function etiologies(): HasMany
    {
        return $this->hasMany(Etiology::class);
    }

    /**
     * Get the askep cases associated with the diagnosis.
     */
    public function askepCases(): HasMany
    {
        return $this->hasMany(AskepCase::class);
    }
}
