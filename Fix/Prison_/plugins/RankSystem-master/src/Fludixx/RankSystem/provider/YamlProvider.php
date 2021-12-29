<?php

/**
 * RankSystem - YamlProvider.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem\provider;

use Fludixx\RankSystem\Rank;
use Fludixx\RankSystem\RankSystem;
use Fludixx\RankSystem\RSPlayer;
use pocketmine\Player;
use pocketmine\utils\Config;

class YamlProvider implements ProviderInterface {

	/** @var Config */
	protected $ranks;
	/** @var Config */
	protected $players;
	/** @var string */
	protected $path;

	public function __construct(string $path)
	{
		$this->path = $path;
		if(!is_file("{$path}ranks.yml")) {
			$this->ranks = new Config("{$path}ranks.yml", 2);
			$this->ranks->setAll([
				'nicks' => [
					'KingGh8', 'Uchiahs54', 'DosenYannick33', 'Rkj65'
				],
				'player' => [
					'default' => true,
					'chatformat' => "§7[Player]§f %player%§7: %msg%",
					'nametag' => "§7[Player]§f %player%",
					'permissions' => ['example1', 'example2']
				]
			]);
			$this->ranks->save();
		}
		if(!($this->ranks instanceof Config))
			$this->ranks = new Config("{$path}ranks.yml", 2);
		$this->players = new Config("{$path}players.yml", 2);
	}

	public function loadRanks()
	{
		$this->ranks = new Config("{$this->path}ranks.yml", 2);
		$this->players = new Config("{$this->path}players.yml", 2);
		foreach ($this->ranks->getAll() as $name => $data) {
			if($name != 'nicks') {
				RankSystem::$ranks[$name] = new Rank($name, $data['chatformat'], $data['nametag'], $data['permissions'], $data['default']);
			} else {
				RankSystem::$nicks = $data;
			}
		}
		foreach (RankSystem::$players as $player) {
			RankSystem::$players[$player->getPlayer()->getName()] = new RSPlayer($player->getPlayer(),
				RankSystem::$ranks[$player->getRank()->getName()]);
		}
	}

	public function setRankOfPlayer(RSPlayer $player, Rank $rank)
	{
		RankSystem::$players[$player->getPlayer()->getName()] = $player->setRank($rank);
		$data = $this->players->get($player->getPlayer()->getName());
		$data['rank'] = $rank->getName();
		$this->players->set($player->getPlayer()->getName(), $data);
		$this->players->save();
	}

	/**
	 * @param Player $player
	 * @return bool
	 * @throws InvalidConfigurationException
	 */
	public function isPlayerRegistered(Player $player) : bool
	{
		$isReg = $this->players->exists($player->getName());
		if(!$isReg) {
			$defaultRank = NULL;
			foreach ($this->ranks->getAll() as $name => $data) {
				if($name != 'nicks') {
					if ($data['default']) {
						$defaultRank = $name;
						break;
					}
				}
			}
			if (is_null($defaultRank)) {
				throw new InvalidConfigurationException("No Default Rank Found");
			}
			$this->players->set($player->getName(), [
				'rank' => $defaultRank,
				'permissions' => []
			]);
			$this->players->save();
		}
		return $isReg;
	}

	public function loginPlayer(string $player)
	{
		$data = [
			'player' => $player,
			'rank' => $this->players->get($player)['rank'],
			'nick' => is_null($this->players->getNested("{$player}.nick")) ? NULL : $this->players->getNested("{$player}.nick")
		];
		RankSystem::callback($data, RankSystem::ACTION_LOGIN_PLAYER);
	}

	public function getAllRanks() : array {
		$ranks = [];
		foreach ($this->ranks->getAll() as $name => $data) {
			$ranks[$name] = $data;
		}
		return $ranks;
	}

	/**
	 * @return Rank
	 * @throws InvalidConfigurationException
	 */
	public function getDefaultRank() : Rank
	{
		$defaultRank = NULL;
		foreach ($this->ranks->getAll() as $name => $data) {
			if($name != 'nicks') {
				if ($data['default']) {
					$defaultRank = $name;
					break;
				}
			}
		}
		if (is_null($defaultRank)) {
			throw new InvalidConfigurationException("No Default Rank Found");
		}
		return RankSystem::$ranks[$defaultRank];
	}

	/**
	 * @param RSPlayer $player
	 * @return void
	 */
	public function saveNick(RSPlayer $player)
	{
		$nick = is_null($player->nick) ? 'null' : $player->nick;
		$this->players->setNested("{$player->getPlayer()->getName()}.nick", $nick);
	}
}