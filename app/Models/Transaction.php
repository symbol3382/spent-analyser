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
        'category_id',
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
