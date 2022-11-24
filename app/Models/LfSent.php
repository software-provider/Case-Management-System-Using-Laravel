<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LfSent extends Model {
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
        'linked_case',
        'settlement_id',
        'description',
        'amount_sent',
        'file_upload'
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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lf_sent';
}
