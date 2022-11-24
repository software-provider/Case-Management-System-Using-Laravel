<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListedCase extends Model {
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
        'client',
        'seller',
        'status'
    ];

    /**
     *
     * Get the client associated with case
     */
    public function client() {
        return $this->hasOne(User::class, 'id', 'client');
    }

    /**
     *
     * Get the law firm associated with case
     */
    public function law_firm() {
        return $this->hasOne(User::class, 'id', 'law_firm');
    }

    /**
     *
     * Get the allowed user associated with case
     */
    public function allowed_user() {
        return $this->hasOne(User::class, 'id', 'allowed_user');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'listed_cases';
}
