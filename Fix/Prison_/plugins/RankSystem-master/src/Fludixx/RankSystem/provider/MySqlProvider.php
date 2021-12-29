<?php

/**
 * RankSystem - MySqlProvider.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem\provider;

use Fludixx\RankSystem\Rank;
use Fludixx\RankSystem\RankSystem;
use Fludixx\RankSystem\RSPlayer;
use Fludixx\RankSystem\task\MySqlTask;
use Fludixx\RankSystem\utils\Utils;
use pocketmine\Player;

class MySqlProvider implements ProviderInterface {

	/** @var string[] */
	protected $login;
	/** @var string */
	protected $default;

	public function __construct()
	{
		$this->login = (array)RankSystem::getSettings()['mysql'];
		RankSystem::getInstance()->getServer()->getAsyncPool()->submitTask(new MySqlTask(
			"CREATE TABLE IF NOT EXISTS `ranks` (
			`rankName` VARCHAR(32) PRIMARY KEY,
			`rankPerms` TEXT NOT NULL,
			`rankNametag` VARCHAR(128) NOT NULL,
			`rankChatformat` VARCHAR(128) NOT NULL,
			`isDefault` BOOLEAN NOT NULL
		) ENGINE = InnoDB;", $this->login));
		RankSystem::getInstance()->getServer()->getAsyncPool()->submitTask(new MySqlTask(
			"CREATE TABLE IF NOT EXISTS `players` (
			`playerName` VARCHAR(15) PRIMARY KEY,
			`playerRank` VARCHAR(32) NOT NULL,
			`playerPerms` TEXT NOT NULL,
			`playerNick` VARCHAR(15) DEFALUT ('null')
		) ENGINE = InnoDB;", $this->login));
		RankSystem::getInstance()->getServer()->getAsyncPool()->submitTask(new MySqlTask(
			"CREATE TABLE IF NOT EXISTS `nicks` (
			`nickName` VARCHAR(15) PRIMARY KEY
		) ENGINE = InnoDB;", $this->login));
	}

	public function loadRanks()
	{
		$conn = new \mysqli($this->login['host'], $this->login['user'], $this->login['pass'], $this->login['db']);
		$result = $conn->query("SELECT * FROM ranks");
		while ($data = mysqli_fetch_array($result)) {
			RankSystem::$ranks[$data['rankName']] = new Rank($data['rankName'], $data['rankChatformat'], $data['rankNametag'],
				Utils::permStringToArray($data['rankPerms']), $data['isDefault'] == 1 ? TRUE : FALSE);
			if($data['isDefault'] == 1)
				$this->default = $data['rankName'];
		}
		if($this->default === NULL) {
			RankSystem::getInstance()->getServer()->getAsyncPool()->submitTask(new MySqlTask(
				"INSERT IGNORE INTO ranks(rankname, rankPerms, rankNametag, rankChatformat, isDefault)
				VALUES('player', 'perm1;perm2', '§7[Player]§f %player%', '§7[PLAYER]§f %player%§7: %msg%', 1)", $this->login
			));
		}
		foreach (RankSystem::$players as $player) {
			if($player instanceof RSPlayer and $player->getPlayer() instanceof Player and $player->getRank() instanceof Rank)
				RankSystem::$players[$player->getPlayer()->getName()] = new RSPlayer($player->getPlayer(),
					RankSystem::$ranks[$player->getRank()->getName()]);
		}
		$result = $conn->query("SELECT * FROM nicks");
		while ($data = \mysqli_fetch_array($result))
			RankSystem::$nicks[] = $data['nickName'];
	}

	public function setRankOfPlayer(RSPlayer $player, Rank $rank)
	{
		RankSystem::$players[$player->getPlayer()->getName()] = $player->setRank($rank);
		RankSystem::getInstance()->getServer()->getAsyncPool()->submitTask(new MySqlTask(
			"UPADTE players SET playerRank='{$rank->getName()} WHERE playerName='{$player->getPlayer()->getName()}'", $this->login
		));
	}

	/**
	 * @param Player $player
	 * @return bool
	 * @throws InvalidConfigurationException
	 */
	public function isPlayerRegistered(Player $player) : bool
	{
		if (is_null($this->default)) {
			throw new InvalidConfigurationException("No Default Rank Found");
		}
		if(!isset(RankSystem::$players[$player->getName()])) {
			RankSystem::getInstance()->getServer()->getAsyncPool()->submitTask(new MySqlTask(
				"INSERT IGNORE INTO players(playerName, playerRank, playerPerms) VALUES('{$player->getName()}', '{$this->default}', '')", $this->login
			));
		}
		return true;
	}

	public function loginPlayer(string $player)
	{
		RankSystem::getInstance()->getServer()->getAsyncPool()->submitTask(new MySqlTask(
			"SELECT * FROM players WHERE playerName='{$player}'", $this->login, RankSystem::ACTION_LOGIN_PLAYER, $player
		));
	}

	public function saveNick(RSPlayer $player) {
		$nick = is_null($player->nick) ? 'null' : $player->nick;
		RankSystem::getInstance()->getServer()->getAsyncPool()->submitTask(new MySqlTask(
			"UPDATE players SET playerNick='$nick' WHERE playerName='{$player->getPlayer()->getName()}'", $this->login
		));
	}

	public function getDefaultRank() : Rank {
		return RankSystem::$ranks[$this->default];
	}

}