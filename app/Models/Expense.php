<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model {
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
        'amount',
        'linked_cases',
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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expenses';
}
