<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $category_name
 * @property int|null $parent_category_id
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCategoryName($value)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereCreatedBy($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereParentCategoryId($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Category extends BaseModel {
    use HasFactory;

    public static $primaryKeyName = '_id';

    protected $fillable = [
        'category_name',
        'parent_category_id',
        'created_by',
    ];

    public function parentCategory(): BelongsTo {
        return $this->belongsTo(Category::class, 'parent_category_id', 'id');
    }
}
