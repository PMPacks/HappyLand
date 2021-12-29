<?php

/**
 * RankSystem - RankSystem.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem;

use Fludixx\RankSystem\command\nickCommand;
use Fludixx\RankSystem\command\rsCommand;
use Fludixx\RankSystem\command\setrankCommand;
use Fludixx\RankSystem\event\ChatEventListener;
use Fludixx\RankSystem\event\JoinEventListener;
use Fludixx\RankSystem\provider\MySqlProvider;
use Fludixx\RankSystem\provider\ProviderInterface;
use Fludixx\RankSystem\provider\YamlProvider;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class RankSystem extends PluginBase {

	const PREFIX = "§7[§eRankSystem§7] §f";
	const ACTION_LOGIN_PLAYER = 0;
	const ACTION_LOAD_NICKS = 1;

	/** @var RankSystem */
	protected static $instance;
	/** @var array */
	protected static $settings;
	/** @var ProviderInterface */
	protected static $provider;
	/** @var string[] */
	public static $nicks = [];
	/** @var RSPlayer[] */
	public static $players = [];
	/** @var Rank[] */
	public static $ranks = [];

	public function onEnable()
	{
		self::$instance = $this;
		if(!is_dir($this->getDataFolder()))
			@mkdir($this->getDataFolder());
		if(!is_file($this->getDataFolder()."config.yml")) {
			$this->getConfig()->setAll([
				'provider' => 'yaml',
				'config_storage' => $this->getDataFolder(),
				'mysql' => [
					'host' => '127.0.0.1',
					'user' => 'admin',
					'pass' => 'admin',
					'db' => 'database'
				]
			]);
			$this->getConfig()->save();
		}
		self::$settings = $this->getConfig()->getAll();
		switch (self::$settings['provider']) {
			case 'yaml':
			case 'yml' :
				self::$provider = new YamlProvider(self::$settings['config_storage']);
				break;
			case 'mysql':
				self::$provider = new MySqlProvider(self::$settings['mysql']);
				break;
			default:
				$this->getLogger()->notice("Unknown Provider ".self::$settings['provider'].", falling back to YAML");
				self::$provider = new YamlProvider(self::$settings['config_storage']);
				break;
		}
		self::loadRanks();
		$this->registerEvents();
		$this->registerCommands();
	}

	public static function callback($data, $action) {
		switch ($action) {
			case RankSystem::ACTION_LOGIN_PLAYER:
				$player = Server::getInstance()->getPlayerExact($data['player']);
				if($player instanceof Player)
					self::$players[$player->getName()] = new RSPlayer($player, self::$ranks[$data['rank']], $data['nick']);
				break;
		}
	}

	public static function loadRanks() {
		RankSystem::$provider->loadRanks();
	}

	/**
	 * @return array
	 */
	public static function getSettings() : array
	{
		return self::$settings;
	}

	/**
	 * @return ProviderInterface
	 */
	public static function getProvider() : ProviderInterface
	{
		return self::$provider;
	}

	protected function registerEvents() {
		$pm = $this->getServer()->getPluginManager();
		$pm->registerEvents(new JoinEventListener(), $this);
		$pm->registerEvents(new ChatEventListener(), $this);
	}

	protected function registerCommands() {
		$map = $this->getServer()->getCommandMap();
		$map->register("setrank", new setrankCommand());
		$map->register("rs", new rsCommand());
		$map->register("nick", new nickCommand());
	}

	/**
	 * @return RankSystem
	 */
	public static function getInstance() : RankSystem
	{
		return self::$instance;
	}

}