<?php 

namespace custom;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantInstance;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
Class Main extends PluginBase implements Listener{

 public $prefix = "§a[§eCUSTOMIT§a]§r ";
 
 public function onEnable(){
   $this->getServer()->getPluginManager()->registerEvents($this, $this);
   $this->getLogger()->info("§bLOADING...");
   }
   
   public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
   switch($cmd->getName()){
   case "setname":
   $name = $sender->getName();
	  $text = implode(" ", $args);
$item = $sender->getInventory()->getItemInHand();
$item->setCustomname($text);
$sender->getInventory()->setItemInHand($item);
$sender->sendMessage($this->prefix."§aĐặc tên thành công");
 break;
 return true;
 case "setlore":
  $name = $sender->getName();
   /*$br = explode("\\n", $text);
					//$text = "";
					foreach($br as $line) 
						$args .= $line."\n";*/
						
  //  $lore = implode(str_replace("{line}","\n", $args));
 
  $lore = implode(" ", $args);
  $lore = explode("\\n",$lore);
 $item = $sender->getInventory()->getItemInHand();
 $item->setLore($lore);
$sender->getInventory()->setItemInHand($item);
$sender->sendMessage($this->prefix."§aSet lore thành công");
		}
		return true;
	}
}