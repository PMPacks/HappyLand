<?php
declare(strict_types=1);

namespace Scoreboards;

use pocketmine\scheduler\Task;
use pocketmine\Player;
use pocketmine\Server;
use Scoreboards\Scoreboards;
use pocketmine\utils\Config;
use pocketmine\network\mcpe\protocol\{SetDisplayObjectivePacket, SetScorePacket};
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;

class ChangingScoreboard extends Task{

	/** @var Main $plugin */
	private $plugin;
	/** @var int $titleIndex */
	private $titleIndex;

	public function __construct(Player $player, int $titleIndex){
		$this->titleIndex = $titleIndex;
		$this->player = $player;
	}

	public function onRun(int $currentTick): void{
		$this->titleIndex++;
		$config = Scoreboards::getInstance()->getConfig();
		$player = $this->player;
		$titles = is_array($config->get("titles")) ? $config->get("titles") : ["UPDATE CONFIG"];
		$lines = is_array($config->get("lines")) ? $config->get("lines") : ["UPDATE CONFIG"];
		
		if($config->get("money")) $this->money = Scoreboards::getInstance()->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        if($config->get("money")) $money = $this->money->mymoney($player);
        
        if($config->get("faction")) $this->factions = Scoreboards::getInstance()->getServer()->getPluginManager()->getPlugin($config->get("faction.plugin"));
        if($config->get("faction"))	$faction = $this->factions->getPlayerFaction($player->getName());
        	
        if($config->get("rank")) $this->rank = Scoreboards::getInstance()->getServer()->getPluginManager()->getPlugin("Prison");
        if($config->get("rank")) $rank = $this->rank->getPlayer($player)->getRank($player);
		
		$lines = str_replace("{name}", $player->getName(), $lines);
        $lines = str_replace("{x}", $player->getX(), $lines);
        $lines = str_replace("{y}", $player->getY(), $lines);
        $lines = str_replace("{z}", $player->getZ(), $lines);
        if($config->get("money")) $lines = str_replace("{money}", $money, $lines);
        if($config->get("faction")) $lines = str_replace("{faction}", $faction, $lines);
        if($config->get("rank")) $lines = str_replace("{rank}", $rank, $lines);
        $lines = str_replace("{online}", Scoreboards::getInstance()->getServer()->getQueryInformation()->getPlayerCount(), $lines);
        $lines = str_replace("{max}", Scoreboards::getInstance()->getServer()->getQueryInformation()->getMaxPlayerCount(), $lines);
        $lines = str_replace("{version}", Scoreboards::getInstance()->getServer()->getVersion(), $lines);
        $lines = str_replace("&", "§", $lines);
        $lines = str_replace("{tps}", Scoreboards::getInstance()->getServer()->getTicksPerSecond(), $lines);
        $lines = str_replace("{ping}", $player->getPing(), $lines);
		
		if(!isset($titles[$this->titleIndex])) $this->titleIndex = 0;
		$api = Scoreboards::getInstance();
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