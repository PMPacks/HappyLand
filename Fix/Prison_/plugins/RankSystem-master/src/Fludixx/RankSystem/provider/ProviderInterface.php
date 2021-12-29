<?php

/**
 * RankSystem - ProviderInterface.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem\provider;

use Fludixx\RankSystem\Rank;
use Fludixx\RankSystem\RSPlayer;
use pocketmine\Player;

interface ProviderInterface {

	/**
	 * @return void
	 */
	public function loadRanks();

	/**
	 * @param RSPlayer $player
	 * @param Rank     $rank
	 * @return void
	 */
	public function setRankOfPlayer(RSPlayer $player, Rank $rank);

	/**
	 * @param Player $player
	 * @return boolean
	 * @throws InvalidConfigurationException
	 */
	public function isPlayerRegistered(Player $player) : bool;

	/**
	 * @param string $player
	 * @return void
	 */
	public function loginPlayer(string $player);

	/**
	 * @return Rank
	 */
	public function getDefaultRank() : Rank;

	/**
	 * @param RSPlayer $player
	 * @return void
	 */
	public function saveNick(RSPlayer $player);

}