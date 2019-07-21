<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Player
 * @package App
 *
 * @property int $id
 * @property float $balance
 */
class Player extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'balance',
    ];

    /**
     * @return HasMany
     */
    public function bets(): HasMany
    {
        return $this->hasMany(Bet::class);
    }

    /**
     * @return HasMany
     */
    public function balanceTransactions(): HasMany
    {
        return $this->hasMany(BalanceTransaction::class);
    }
}
