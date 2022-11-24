<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model {
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
        'doe',
        'name',
        'total_amount_frozen',
        'units_sold',
        'product_gmv',
        'amount_frozen_usd',
        'amount_frozen_cny',
        'marketplace',
        'linked_case',
        'product_url',
        'store_url'
    ];

    /**
     *
     * Get the marketplace associated with case
    */
    public function marketplace() {
        return $this->hasOne(Marketplace::class, 'id', 'marketplace');
    }

    /**
     *
     * Get the marketplace associated with case
    */
    public function linked_case() {
        return $this->hasOne(ListedCase::class, 'id', 'linked_case');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sellers';
}
