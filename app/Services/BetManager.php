<?php

namespace App\Services;

use App\Bet;
use App\Player;

/**
 * Class BetManager
 * @package App\Services
 */
class BetManager
{
    /**
     * @var Player
     */
    protected $player;

    /**
     * @var BalanceManager
     */
    protected $balanceManager;

    /**
     * BetManager constructor.
     * @param Player $player
     * @param BalanceManager $balanceManager
     */
    public function __construct(Player $player, BalanceManager $balanceManager)
    {
        $this->player = $player;
        $this->balanceManager = $balanceManager;
    }

    /**
     * @param array $data
     * @return Bet
     * @throws \Throwable
     */
    public function create(array $data): Bet
    {
        $player = $this->getPayer($data);
        /** @var Bet $bet */
        $bet = $player->bets()->create($data);
        foreach ($data['selections'] as $selection) {
            $bet->betSelections()->create([
                'odds' => $selection['odds'],
                'selection_id' => $selection['id'],
            ]);
        }

        $this->balanceManager->createTransaction($player, $data['stake_amount']);

        return $bet;
    }

    /**
     * @param array $data
     * @return Player
     */
    protected function getPayer(array $data): Player
    {
        $player = $this->player->newQuery()->find($data['player_id']);
        if (!$player) {
            $player = new Player();
            $player->id = $data['player_id'];
            $player->save();
        }

        return $player;
    }
}
