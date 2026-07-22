<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'user_id',
        'old_status',
        'new_status',
        'note',
    ];

    /**
     * البلاغ المرتبط بالتحديث.
     */
    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * المستخدم الذي قام بالتحديث.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}