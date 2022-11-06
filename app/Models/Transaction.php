<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $amount
 * @property int $user_id
 * @property string $transaction_type
 * @property Carbon $transaction_time
 * @property int $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category $category
 * @property-read User $user
 * @method static Builder|Transaction newModelQuery()
 * @method static Builder|Transaction newQuery()
 * @method static Builder|Transaction query()
 * @method static Builder|Transaction whereAmount($value)
 * @method static Builder|Transaction whereCategoryId($value)
 * @method static Builder|Transaction whereCreatedAt($value)
 * @method static Builder|Transaction whereId($value)
 * @method static Builder|Transaction whereTransactionTime($value)
 * @method static Builder|Transaction whereTransactionType($value)
 * @method static Builder|Transaction whereUpdatedAt($value)
 * @method static Builder|Transaction whereUserId($value)
 * @mixin Eloquent
 */
class Transaction extends Model {
    use HasFactory;

    protected $fillable = [
        'amount',
        'user_id',
        'transaction_time',
        'transaction_type',
        'comment',
        'category_id',
    ];

    protected $casts = [
        'transaction_time' => 'datetime',
    ];

    public static $transactionType_Credit = 'C';
    public static $transactionType_Debit = 'D';

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class,  'user_id', 'id');
    }
}
