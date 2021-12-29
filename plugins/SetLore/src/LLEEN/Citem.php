<?php
namespace LLEEN;

use pocketmine\plugin\PluginBase;
use pocketmine\command\{Command,CommandSender};
use pocketmine\item\Item;
use pocketmine\enchantment\Enchantment;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

class Citem extends PluginBase{

	public function onEnable(){
		$this->getLogger()->info("NOThing in onEnable");
	}

	public function onCommand(CommandSender $sender,Command $cmd,string $label,array $args) : bool{
		if(!$sender instanceof Player)
        {
		   $sender->sendMessage("Player Only");
           return false; 
        }
        $item = $sender->getInventory()->getItemInHand();
        if($cmd->getName() == "setname"){
            if($sender->isOP()){
                if($item->getId() == 0){
                    $sender->sendMessage("§c§lBạn không cầm item nào trên tay!");
                }
                else{
                    $cloned = clone $item;
                    $cloned->setCustomName($args[0]);
                    $sender->getInventory()->remove($item);
                    $sender->getInventory()->addItem($cloned);
                    $sender->sendMessage("§e§lBạn đã đổi tên đồ thành ". $args[0]. " §ethành công");
                }
            }
            else{
                $sender->sendMessage("§c§lBạn không có quyền sử dụng plugin này");
            }
            return true;
        }
        if($cmd->getName() == "setlore"){
            if($sender->isOP()){
                if($item->getId() == 0){
                    $sender->sendMessage("§c§lBạn không cầm item nào trên tay!");
                }
                else{
                    $cloned = clone $item;
                    $cloned->setLore($args);
                    $sender->getInventory()->remove($item);
                    $sender->getInventory()->addItem($cloned);
					$sender->sendMessage("§e§lSet Lore thành công");
                }
            }
            else{
                $sender->sendMessage("§c§lBạn không có quyền sử dụng plugin này");
			}
            return true;
        }
        if($cmd->getName() == "dellore"){
            if($sender->isOP()){
                if($item->getId() == 0){
                    $sender->sendMessage("§c§lBạn không cầm item nào trên tay");
                }
                else{
                    $item->setLore([]);
                }
            }
            else{
                $sender->sendMessage("§c§lBạn không có quyền sử dụng plugin này");
            }
            return true;
        }
        if($cmd->getName() == "addlore"){
        	if($sender->isOP()){
                if($item->getId() == 0){
                    $sender->sendMessage("§c§lBạn không cầm item nào trên tay");
                }
                else{
                	/*
                	* @var array $oldLore
                	*	   
					*/
                	$oldLore = $item->getLore();
                	array_push($oldLore,$args[0]); 
                	$cloned = clone $item;
                    $cloned->setLore($oldLore);
                    $sender->getInventory()->remove($item);
                    $sender->getInventory()->addItem($cloned);
                	
                }
            }
            else{
                $sender->sendMessage("§c§lBạn không có quyền sử dụng plugin này");
            }
        }
        return true;
	}
}