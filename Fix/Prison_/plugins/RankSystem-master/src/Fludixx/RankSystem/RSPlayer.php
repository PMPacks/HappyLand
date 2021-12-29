<?php

/**
 * RankSystem - RSPlayer.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem;

use pocketmine\Player;

class RSPlayer {

	/** @var Rank */
	public $rank;
	/** @var Player */
	public $player;
	/** @var string|null */
	public $nick;

	/**
	 * RSPlayer constructor.
	 * @param Player      $player
	 * @param Rank        $rank
	 * @param null|string $nick
	 */
	public function __construct(Player $player, Rank $rank, $nick = NULL)
	{
		$this->load($player, $rank, $nick);
	}

	/**
	 * @return Player
	 */
	public function getPlayer() : Player
	{
		return $this->player;
	}

	/**
	 * @return Rank
	 */
	public function getRank() : Rank
	{
		return $this->rank;
	}

	/**
	 * @param Rank $rank
	 * @return RSPlayer
	 */
	public function setRank(Rank $rank) : RSPlayer
	{
		$this->rank = $rank;
		return $this;
	}


	/**
	 * @return string
	 */
	public function getNick() {
		return is_null($this->nick) ? $this->player->getName() : $this->nick;
	}

	/**
	 * @param $nick string|null
	 */
	public function setNick($nick) {
		$this->nick = $nick;
	}

	/**
	 * @param Player      $player
	 * @param Rank        $rank
	 * @param string|null $nick
	 * @return RSPlayer
	 */
	public function load(Player $player, Rank $rank, $nick) {
		$this->player = $player;
		$this->rank = $rank;
		$this->nick = $nick;
		$nametag = is_null($this->nick) ? $this->getRank()->getNametag() : RankSystem::getProvider()->getDefaultRank()->getNametag();
		$nametag = str_replace("%player%", $this->player->getName(), $nametag);
		$this->player->setNameTag($this->getNick());
		$this->player->setDisplayName($nametag);
		foreach ($rank->getPermissions() as $permission) {
			if($permission == "*")
				$player->setOp(TRUE);
            if($player instanceof Player)
                $player->addAttachment(RankSystem::getInstance())->setPermission($permission ,TRUE);
		}
		return $this;
	}

}