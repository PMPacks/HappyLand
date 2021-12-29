<?php

namespace Syams255;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;

class ItemID extends PluginBase implements Listener {

        public $slogan = "§l[§eITEM ID§f]§a";
        
	public function onEnable()
	{
		  $this->getLogger()->info("Â§eItemsID by Syams255[S255][S225]");
                  $this->getServer()->getPluginManager()->registerEvents($this ,$this);
        }
        
        public function ItemHeld(PlayerItemHeldEvent $event)
        {
            $pl = $event->getPlayer();
            if($pl->isOp())
            {
            $pl->sendTip($this->slogan . " " . $event->getItem()->getId() . "§b:§f" . $event->getItem()->getDamage());
            }
        }

}
