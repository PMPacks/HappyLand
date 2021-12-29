<?php

namespace WinterBuild7074\ItemFrameProtector;

use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\level\Level;

class Main extends PluginBase implements Listener {
	
	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):  bool {
		switch($cmd->getName()) {
			case "itemframes":
			case "banitemframes":
				if($sender->hasPermission("itemframes.tools")) {
					if(isset($args[0])) {
						if(strtolower($args[0]) === "add") {
							if(isset($args[1])) {
								$protectedworlds = $this->getConfig()->get("ProtectedWorlds");
								$worldname = $args[1];
								if($this->getServer()->isLevelGenerated($worldname)) {
									if(!in_array($worldname, $protectedworlds)) {
										$protectedworlds[] = $worldname;
										$this->getConfig()->set("ProtectedWorlds", $protectedworlds);
										$this->getConfig()->save();
										$sender->sendMessage("§aAdded world §o" . $worldname . "§r§a to the protected item frames list.");
									} else {
										$sender->sendMessage("§cCouldn't add world because it is added to the protected item frames list already.");
									}
								} else {
									$sender->sendMessage("§cWorld doesn't exist.");
								}
							} else {
								$sender->sendMessage("§cUsage: /" . $label . " <add|remove> <worldName>");
							}
						} elseif(strtolower($args[0]) === "remove") {
							if(isset($args[1])) {
								$protectedworlds = $this->getConfig()->get("ProtectedWorlds");
								$worldname = $args[1];
								if($this->getServer()->isLevelGenerated($worldname)) {
									if(in_array($worldname, $protectedworlds)) {
										$pos = array_search($worldname, $protectedworlds);
										unset($protectedworlds[$pos]);
										$this->getConfig()->set("ProtectedWorlds", $protectedworlds);
										$this->getConfig()->save();
										$sender->sendMessage("§aRemoved world §o" . $worldname . "§r§a from the protected item frames list.");
									} else {
										$sender->sendMessage("§cCouldn't remove world because it isn't added to the protected item frames list.");
									}
								} else {
									$sender->sendMessage("§cWorld doesn't exist.");
								}
							} else {
								$sender->sendMessage("§cUsage: /" . $label . " <add|remove> <worldName>");
							}
						} else {
							$sender->sendMessage("§cUsage: /" . $label . " <add|remove> <worldName>");
						}
					} else {
						$sender->sendMessage("§cUsage: /" . $label . " <add|remove> <worldName>");
					}
				}
				break;
		}
		return false;
	}
	
	public function onTouch(PlayerInteractEvent $event) {
		$block = $event->getBlock();
		$player = $event->getPlayer();
		$level = $player->getLevel();
		$levelname = $player->getLevel()->getName();
		$protectedworlds = $this->getConfig()->get("ProtectedWorlds");
		if($block->getId() === Block::ITEM_FRAME_BLOCK) {
			if(in_array($levelname, $protectedworlds)) {
				if(!$player->hasPermission("itemframes.touch") || !$player->isOp()) {
					$event->setCancelled();
				}
			}
		}
	}
}
