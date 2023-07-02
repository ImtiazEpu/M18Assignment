<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'category_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @param $categoryId
     *
     * @return int
     */
    public static function getCountByCategory($categoryId): int {
        return self::where('category_id', $categoryId)->count();
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }


}
