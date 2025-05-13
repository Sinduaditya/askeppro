<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'medical_record_number', 'birth_date', 'gender', 'blood_type', 'address', 'notes'];

    protected $casts = [
        'birth_date' => 'datetime',
    ];

    /**
     * Get the user that owns the patient.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the askep cases for the patient.
     */
    public function askepCases(): HasMany
    {
        return $this->hasMany(AskepCase::class);
    }

    public function getFormattedMedicalRecordAttribute()
    {
        return $this->medical_record_number ?? 'Belum ada nomor rekam medis';
    }
}
