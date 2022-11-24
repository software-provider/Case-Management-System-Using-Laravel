<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model {
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'description',
        'amount ',
        'linked_case',
        'settlement_id',
        'seller_id'
    ];

    /**
     *
     * Get linked case
     */
    public function linked_case() {
        return $this->hasOne(ListedCase::class, 'id', 'linked_case');
    }

    /**
     *
     * Get linked settlement
     */
    public function settlement() {
        return $this->hasOne(Settlement::class, 'id', 'settlement_id');
    }

    /**
     *
     * Get linked seller
     */
    public function seller() {
        return $this->hasOne(Seller::class, 'id', 'seller_id');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'incomes';
}
