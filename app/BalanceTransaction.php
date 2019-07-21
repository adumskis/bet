<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BalanceTransaction
 * @package App
 *
 * @property int $id
 * @property float $amount
 * @property float $amount_before
 */
class BalanceTransaction extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'player_id',
        'amount',
        'amount_before'
    ];
}
