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
		
		$this->enchant = ["0: Protection","1:Fire Protection","2:Feather Falling","3:Blast Protection","4:Projectile Protection","5:Thorns","6:Respiration","7:Depth Strider","8:Aqua Affinity","9:Sharpness","10:Smite","11:Bane of Athropods","12:Knockback","13:Fire Aspect","14:Looting","15:Efficiency","16:Silk Touch","17:Unbreaking","18:Fortune","19:Power","20:Punch","21:Flame","22:Infinity","23:Luck of the Sea",
"24:Lure"];
	}
	
	/*
	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	!                                !
	!     Khong them dau vao chu     !
	!                                !
	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	*/
public function onCommand(CommandSender $s,Command $cmd,string $label, array $args) : bool{
		
		if($cmd->getName() == "buyec") {
			
			if(isset($args[0]) && isset($args[1])) {				  
				if(is_numeric($args[0])) {					  
					if(is_numeric($args[1])) {						
						if($this->eco->myMoney($s->getName()) >= "20000") {		  
							$enchantLevel = $args[1];
							$enchantId = $args[0];
							$enchantment = Enchantment::getEnchantment($enchantId);
			
							if(empty($enchantment)){								
								$enchantment = Enchantment::getEnchantmentByName($enchantId);								
								if(empty($enchantment)){
									$s->sendMessage("enchant này không tồn tại");
									return true;
								}
							}
							
							$id = $enchantment->getId();
							$maxLevel = 5;
							
							if($enchantLevel > $maxLevel or $enchantLevel <= 0){
								$s->sendMessage("cấp enchant tối đa là:". $maxLevel);
								return true;
							}
							
							$instance = new EnchantmentInstance($enchantment, $enchantLevel);
							$item = $s->getInventory()->getItemInHand();
							if($item->getId() <= 0){
								$s->sendMessage("hãy cầm vật phẩm lên trước khi enchant!!!");
								return true;
							}
							
							/*if($instance::getEnchantAbility($item) === 0){
								$s->sendMessage("Kh�ng th? enchant!");
								return true;
							}
							*/
							$item->addEnchantment($instance);
							$s->getInventory()->setItemInHand($item);
							
							$this->eco->reduceMoney($s->getName(), "20000");
							
							$s->sendMessage("enchant thành công!");
							return true;
					  } else {
						  $s->sendMessage("không đủ tiền!");
						  return false;
						}
					} else {
						$s->sendMessage("cấp phải là số");
						return false;
						}
				  
			  } else {
				  $s->sendMessage("ID Enchant phải là 1 chữ số - /listec nếu bạn quên id!");
				 return false;
			  }
			} else {
				$s->sendMessage("sử dụng: /buyec <ID> <cấp độ>");
				return false;
			}
		}
		
		if($cmd->getName() == "listec") {
			
		  if(isset($args[0])) {

			 			  $pages = array_chunk($this->enchant, 5);
			  if($args[0] <= count($pages) || $args[0] < 1) {
				  
			  
			  $s->sendMessage("Trang ". $args[0] ."/". count($pages));
			  $s->sendMessage("(Tên trước, ID sau)");
			  foreach($pages[$args[0] - 1] as $enchant) {
				  $is = explode(":", $enchant);
				  $s->sendMessage("| ". $is[1] .":". $is[0]);
			  }
			  $s->sendMessage("/buyec <id> <cấp độ>");
			  return true;
		  } else {
			  $s->sendMessage("không tìm thấy trang!!");
			  return false;
		  }
		  } else {
			  $s->sendMessage("/listec <trang>");
			  return true;
		  }
		}
	}
}