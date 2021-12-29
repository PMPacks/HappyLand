<?php

namespace buyec;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase {
	
	public $eco;
	public $enchants;
	
	public function onEnable() {
		$this->eco = EconomyAPI::getInstance();
		$this->getLogger()->info("§b[§a MUA PHÙ PHÉP §b] §a§l Đã Hoạt Động");
		$this->enchant = ["0: Protection","1:Fire Protection","2:Feather Falling","3:Blast Protection","4:Projectile Protection","5:Thorns","6:Respiration","7:Depth Strider","8:Aqua Affinity","9:Sharpness","10:Smite","11:Bane of Athropods","12:Knockback","13:Fire Aspect","14:Looting","15:Efficiency","16:Silk Touch","17:Unbreaking","18:Fortune","19:Power","20:Punch","21:Flame","22:Infinity","23:Luck of the Sea",
"24:Lure"];
	}
	
	
	
	public function onCommand(CommandSender $s, Command $cmd, string $label, array $args):bool {
		
		if($cmd->getName() == "buyec") {
			
		  if(isset($args[0]) && isset($args[1])) {
			  
			  if(is_numeric($args[0])) {
				  
				if(is_numeric($args[1])) {
					$moneyfs = $args[1] * 20000;

			
				  if($this->eco->myMoney($s->getName()) >= $args[1] ."0000") {
					  
					  
		$enchantLevel = $args[1] <= 7 ? $args[1] : 1;
		$enchantId = $args[0];
		$maxLevel = 7;
		
		$enchantment = Enchantment::getEnchantment($enchantId);
	
		
		if($args[0] > 24){
	    		$s->sendMessage("Khong tim thay enchant");
				return true;
			
		}
		$id = $enchantment->getId();
		
		if($args[0] == 10 || $args[0] == 12 || $args[0] == 8){
			  if($args[1] <= 4){
			$s->sendMessage("§l§f• §bMax Level: §63");
			return true;
			  }
		}
		
				  if($args[1] > $maxLevel){
			$s->sendMessage("§l§dMax Enchant Level:§e". $maxLevel);
			return true;
		}
		
		
		$item = $s->getInventory()->getItemInHand();
		if($item->getId() <= 0){
		$s->sendMessage("§cKhông tìm thấy vật phẩm trên tay");
			return true;
		}
		
		/*if(Enchantment::getEnchantAbility($item) === 0){
			$s->sendMessage("Khong the Enchant");
			return true;
		}*/
		$item->addEnchantment(new EnchantmentInstance($enchantment, $enchantLevel));
		$s->getInventory()->setItemInHand($item);
						
						$this->eco->reduceMoney($s->getName(), $args[1] ."0000");
						
						$s->sendMessage("§a§l• §dMua Phù Phép Thành Công");
						return true;
				  } else {
					  $s->sendMessage("§bKhông đủ tiền để Enchant");
					  return false;
				  }
				} else {
					$s->sendMessage("§l§e•§b Level theo dạng chữ số: 1-5");
					return false;
				}
			  
		  } else {
			  $s->sendMessage("§l§e•§b ID theo dạng chữ số: 0-9\n§l§e•§b Xem danh sách ID:§d /listec");
		     return false;
		  }
		} else {
			$s->sendMessage("§l§e•§b Để mua phù phép:§d /buyec [ID] [Level]");
			return false;
		}
		
		}
		if($cmd->getName() == "listec") {
			
		  if(isset($args[0])) {

			 			  $pages = array_chunk($this->enchant, 5);
			  if($args[0] <= count($pages) || $args[0] < 1) {
				  
			  
			  $s->sendMessage("Trang ". $args[0] ."/". count($pages));
			  $s->sendMessage("§l§b(§eTên Enchant, ID Enchant§b)");
			  foreach($pages[$args[0] - 1] as $enchant) {
				  $is = explode(":", $enchant);
				  $s->sendMessage("§b|§a ". $is[1] .":". $is[0]);
			  }
			  $s->sendMessage("§b§lĐể mua một Enchant sử dụng lệnh: §c/buyec <id> <level>");
			  return true;
		  } else {
			  $s->sendMessage("§b§lKhông tìm thấy trang");
			  return false;
		  }
		  }
		}
	}
}