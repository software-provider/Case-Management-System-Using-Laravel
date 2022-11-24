<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model {
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
        'name'
    ];

    /**
     *
     * Get the client associated with case
     */

    /**
     *
     * Get the client associated with case
     */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'marketplaces';
}
