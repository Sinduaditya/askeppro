<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluation extends Model
{
    protected $fillable = ['askep_case_id', 'result', 'notes', 'evaluation_time', 'subjective', 'objective', 'assessment', 'plan'];

    const RESULT_ACHIEVED = 'tercapai';
    const RESULT_NOT_ACHIEVED = 'belum tercapai';

    /**
     * Get the askep case that owns the evaluation.
     */
    public function askepCase(): BelongsTo
    {
        return $this->belongsTo(AskepCase::class, 'askep_case_id');
    }
}
