<?php

namespace cmdsnooper;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class CmdSnooper extends PluginBase {
	public $snoopers = [];
	
	public function onEnable(): void {
		@mkdir($this->getDataFolder());
		$this->getLogger()->info("§aSocial spy has been enabled. §bLet the magic begin. >:D");
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array(
	  	"Console.Logger" => "true",
  		));
	}
	
	 public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {			
		if(strtolower($command->getName()) == "socialspy" or strtolower($command->getName()) == "ss") {
		 	if($sender instanceof Player) {
				if($sender->hasPermission("socialspy.command")) {
					if(!isset($this->snoopers[$sender->getName()])) {
						$sender->sendMessage("§7[§6Void§bSS§7] §bYou have entered socialSpy mode");
						$this->snoopers[$sender->getName()] = $sender;
						return true;
					} else {
						$sender->sendMessage("§7[§6Void§bSS§0]§7> §cYou have left SocialSpy mode");
						unset($this->snoopers[$sender->getName()]);
						return true;
						}
				} else {
       						$sender->sendMessage("§cThis command is for Staff only!");
       						return true;
					}
				}
			}
		return true;
}
	}
