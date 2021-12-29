<?php

declare(strict_types=1);

namespace MrDinoDuck\PhuPhepUI;

use Frago9876543210\EasyForms\elements\{Dropdown, Slider, Element, Label};
use Frago9876543210\EasyForms\forms\CustomForm;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\{Player, Server};
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\{Item, Armor, Tool};
use onebone\economyapi\EconomyAPI;
use MrDinoDuck\PhuPhepUI\forms\EnchantmentForm;

class Main extends PluginBase{

	public function onEnable() : void{
		$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$this->getLogger()->info("BuyECUI by MrDinoDuck");
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch($command->getName()){
			case "buyec":
			$item = $sender->getInventory()->getItemInHand();
//			$whitelistitem = [310, 311, 312, 313, 276, 279, 277, 278, 314, 315, 316, 317, 283, 284, 285, 286, 306, 307, 308, 309, 258, 256, 257, 267, 268, 269, 270, 271, 298, 299, 300, 301, 259, 359, 346, 261];
				if($item->getId() == 0){
					$sender->sendMessage("§d✿§e EnchantmentUI§d ✿§e>§c Bạn không cầm item gì hết!");
					return true;
				}
				$form = new EnchantmentForm($this);
				$sender->sendForm($form);
				return true;
		}
	}
	public function onDisable() : void{
		$this->getLogger()->info("BuyECUI by MrDinoDuck");
	}
}
