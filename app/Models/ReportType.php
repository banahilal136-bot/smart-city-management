<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportType extends Model
{
    use HasFactory;

    public const PRIORITY_LOW = 'low';
    public const PRIORITY_MEDIUM = 'medium';
    public const PRIORITY_HIGH = 'high';

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    protected $fillable = [
        'name',
        'icon',
        'priority',
        'status',
        'department',
        'description',
        'internal_notes',
    ];

    /**
     * البلاغات التابعة لهذا النوع.
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}