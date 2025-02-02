<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    protected $fillable = [
        'visible_to_all',
        'visible_to_all_in_category',
        'section_id',
        'message',
        'image',
        'video',
        'file_path',
        'tag',
    ];

    protected $casts = [
        'visible_to_all' => 'boolean',
        'visible_to_all_in_category' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function setSectionIdAttribute($value)
    {
        if ($this->visible_to_all || $this->visible_to_all_in_category) {
            $this->attributes['section_id'] = null;
        } else {
            $this->attributes['section_id'] = $value;
        }
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($material) {
            if (!in_array($material->user->role, ['tutor', 'super_admin'])) {
                throw new \Exception('Only tutors or super admins can create materials.');
            }
        });
    }
}
