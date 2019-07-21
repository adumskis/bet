<?php

namespace App\Services;

use App\BalanceTransaction;
use App\Player;
use Illuminate\Database\DatabaseManager;

/**
 * Class BalanceManager
 * @package App\Services
 */
class BalanceManager
{
    /**
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * BalanceManager constructor.
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * @param Player $player
     * @param float $amount
     * @return BalanceTransaction
     * @throws \Throwable
     */
    public function createTransaction(Player $player, float $amount): BalanceTransaction
    {
        /** @var BalanceTransaction $balanceTransaction */
        $balanceTransaction = $this->databaseManager->connection()->transaction(function () use ($player, $amount) {
            $player->lockForUpdate();
            $player->refresh();

            /** @var BalanceTransaction $balanceTransaction */
            $balanceTransaction = $player->balanceTransactions()->create([
                'amount' => $amount,
                'amount_before' => $player->balance
            ]);

            $player->balance -= $amount;
            $player->save();

            return $balanceTransaction;
        });

        return $balanceTransaction;
    }
}
