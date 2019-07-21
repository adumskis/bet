<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Bet
 * @package App
 *
 * @property int $id
 * @property float $stake_amount
 * @property Player $player
 * @property Collection|BetSelection[]
 */
class Bet extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'player_id',
        'stake_amount',
    ];

    /**
     * @return BelongsTo
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * @return HasMany
     */
    public function betSelections(): HasMany
    {
        return $this->hasMany(BetSelection::class);
    }
}
