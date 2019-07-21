<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BetSelection
 * @package App
 *
 * @property int $id
 * @property int $bet_id
 * @property int $selection_id
 * @property float $odds
 */
class BetSelection extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'bet_id',
        'selection_id',
        'odds',
    ];
}
