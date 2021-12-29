<?php
namespace blockMCPE14;

use pocketmine\plugin\PluginBase; 
use pocketmine\command\{Command, CommandSender};
use pocketmine\event\{Player\PlayerInteractEvent, Listener};
use pocketmine\block\Block;
use pocketmine\math\Vector3;
class blockMCPE14 extends PluginBase implements Listener{ 

private $rip = [];

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onCommand(CommandSender $s, Command $cmd, string $label, array $args) : bool{
		if(!$s->hasPermission("use.shar")) return false;
			if($cmd->getName () == "block"){
				if(empty($args[0]) or empty($args[1])){
					$s->sendMessage("Use §a/block §f<§7size§f> <§7id§f>");
				return false;
			}
			$this->rip[strtolower($s->getName())] = ["id" => $args[1], "rad" => $args[0]];
			$s->sendMessage("Succesfully!");
			return true;
		}
		return true;
	}

	public function onTap(PlayerInteractEvent $e){
		if($e->getItem()->getId() == 280){
			if(isset($this->rip[strtolower($e->getPlayer()->getName())])){
				$mass = $this->rip[strtolower($e->getPlayer()->getName())];
				for($x = $e->getBlock()->getX() - $mass["rad"]; $x <= $e->getBlock()->getX() + $mass["rad"]; $x++)
				for($y = $e->getBlock()->getY() - $mass["rad"]; $y <= $e->getBlock()->getY() + $mass["rad"]; $y++)
				for($z = $e->getBlock()->getZ() - $mass["rad"]; $z <= $e->getBlock()->getZ() + $mass["rad"]; $z++)
			{
				$pos = new Vector3($e->getBlock()->getX(), $e->getBlock()->getY(), $e->getBlock()->getZ());
				$vec = new Vector3($x, $y, $z);
				if($pos->distance($vec) <= $mass["rad"])
					$e->getPlayer()->getLevel()->setBlock($vec, Block::get($mass["id"], 0));
				}
			$e->getPlayer()->sendMessage("§fШар §aсгенерирован");
		}
	}
}
}  