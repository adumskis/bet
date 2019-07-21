<?php

namespace App\Services\Validation\Validators;

use App\Player;
use App\Services\Validation\InsufficientBalanceError;
use App\Services\Validation\ValidationError;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;

/**
 * Class BalanceValidator
 * @package App\Services\Validation\Validators
 */
class BalanceValidator extends AbstractValidator
{
    /**
     * @var Player
     */
    protected $player;

    /**
     * BalanceValidator constructor.
     * @param Repository $config
     * @param Factory $validationFactory
     * @param Player $player
     */
    public function __construct(Repository $config, Factory $validationFactory, Player $player)
    {
        parent::__construct($config, $validationFactory);

        $this->player = $player;
    }

    /**
     * @param Request $request
     * @return ValidationError|null
     */
    public function validate(Request $request): ?ValidationError
    {
        $balance = Player::DEFAULT_BALANCE;
        /** @var Player $player */
        $player = $this->player->newQuery()->find($request->get('player_id'));
        if($player) {
            $balance = $player->balance;
        }

        if($balance < $request->get('stake_amount')) {
            return new InsufficientBalanceError();
        }

        return null;
    }
}
