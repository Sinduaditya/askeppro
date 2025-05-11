<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Intervention extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'category',
    ];

    public function implementations(): HasMany
    {
        return $this->hasMany(CaseImplementation::class);
    }
}
