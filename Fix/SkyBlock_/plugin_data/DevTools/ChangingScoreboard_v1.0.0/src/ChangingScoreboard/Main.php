<?php
declare(strict_types=1);

namespace ChangingScoreboard;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\Task;
use Scoreboards\Scoreboards;

class Main extends PluginBase{

	public function onEnable(): void{
		$this->saveResource("config.yml");
		$this->getScheduler()->scheduleRepeatingTask(new ChangeScoreboardTask($this, 0), (int)$this->getConfig()->get("update-interval"));
	}
}

class ChangeScoreboardTask extends Task{

	/** @var Main $plugin */
	private $plugin;
	/** @var int $titleIndex */
	private $titleIndex;

	public function __construct(Main $plugin, int $titleIndex){
		$this->plugin = $plugin;
		$this->titleIndex = $titleIndex;
	}

	public function onRun(int $currentTick): void{
		$this->titleIndex++;
		$config = $this->plugin->getConfig();
		$titles = is_array($config->get("titles")) ? $config->get("titles") : ["UPDATE CONFIG"];
		$lines = is_array($config->get("lines")) ? $config->get("lines") : ["UPDATE CONFIG"];
		if(!isset($titles[$this->titleIndex])) $this->titleIndex = 0;
		$api = Scoreboards::getInstance();
		foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
			$api->new($player, $player->getName(), $titles[$this->titleIndex]);
			$i = 0;
			foreach($lines as $line){
				if($i < 15){
					$i++;
					$api->setLine($player, $i, $line);
				}
			}
		}
	}
}