<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Etiology extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_id',
        'description',
    ];

    /**
     * Get the diagnosis that owns the etiology.
     */
    public function diagnosis(): BelongsTo
    {
        return $this->belongsTo(Diagnosis::class);
    }
}
