<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'new';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_RESOLVED = 'resolved';

    protected $fillable = [
        'user_id',
        'report_type_id',
        'title',
        'description',
        'image_path',
        'address',
        'latitude',
        'longitude',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    /**
     * المواطن صاحب البلاغ.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * نوع البلاغ.
     */
    public function reportType(): BelongsTo
    {
        return $this->belongsTo(ReportType::class);
    }

    /**
     * جميع تحديثات هذا البلاغ.
     */
    public function updates(): HasMany
    {
        return $this->hasMany(ReportUpdate::class)
            ->latest();
    }

    /**
     * الاسم العربي لحالة البلاغ.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'جديد',
            self::STATUS_IN_PROGRESS => 'قيد المعالجة',
            self::STATUS_RESOLVED => 'تم الحل',
            default => 'غير معروف',
        };
    }
}