<?php

namespace MF;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\Inventory;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

Class JI extends PluginBase implements Listener{

public function onEnable(){
   $this->getServer()->getPluginManager()->registerEvents($this, $this);
}
public function JoinItems(PlayerJoinEvent $event){
   $sender = $event->getPlayer();
   $name = $sender->getName();
   $code = "tb-";
   $this->getServer()->getCommandMap()->dispatch($sender, $code);
}
public function onDisable(){}
}
?>