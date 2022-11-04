<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model {
    use HasFactory;

    protected $fillable = [
        'amount',
        'user_id',
        'transaction_time',
        'transaction_type',
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
