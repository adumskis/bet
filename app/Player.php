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
    const DEFAULT_BALANCE = 1000;

    /**
     * @var array
     */
    protected $fillable = [
        'balance',
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'balance' => self::DEFAULT_BALANCE
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
