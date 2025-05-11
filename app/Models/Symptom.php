<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Symptom extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'category', 'description'];

    /**
     * Get the cases that this symptom belongs to.
     */
    public function askepCases(): BelongsToMany
    {
        return $this->belongsToMany(AskepCase::class, 'case_symptoms');
    }

    /**
     * Get the diagnoses that this symptom belongs to.
     */
    public function diagnoses(): BelongsToMany
    {
        return $this->belongsToMany(Diagnosis::class, 'diagnosis_symptoms')
                    ->withPivot('is_main');
    }
}
