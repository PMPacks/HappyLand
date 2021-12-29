<?php

declare(strict_types=1);

namespace MrDinoDuck\PhuPhepUI\forms;

use Frago9876543210\EasyForms\elements\{Dropdown, Slider, Element, Label};
use Frago9876543210\EasyForms\forms\CustomForm;
use pocketmine\{Player, Server};
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\{Item, Armor, Tool};
use onebone\economyapi\EconomyAPI;
use MrDinoDuck\PhuPhepUI\Main;

class EnchantmentForm extends CustomForm{
	
	public function __construct(Main $plugin){
		$this->plugin = $plugin;
		parent::__construct("§d✿§e EnchantmentUI§d ✿", [
	new Label("Chào mừng bạn đến shop của máy chủ ^-^. Tự điền tất cả id enchant vào"),
	new Dropdown("Chọn số enchant", ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"]),
	new Slider("Chọn cấp độ", 1, 5)]);
	}
	
	public function onSubmit(Player $player, $response) : void{
		parent::onSubmit($player, $response);
		$dropdown = $this->popElement();
		$slider = $this->popElement();
		$idenchant = $dropdown->getSelectedOption();
		$level = $slider->getValue();
		$item = $player->getInventory()->getItemInHand();
		$money = $this->plugin->eco->myMoney($player);
			if($money >= $level*20000){
				$this->plugin->eco->reduceMoney($player, $level*20000);
				$ec1 = Enchantment::getEnchantment((int)$idenchant);
				$ec1a = new EnchantmentInstance($ec1, (int)$level);
				$item->addEnchantment($ec1a);
				$player->getInventory()->setItemInHand($item);
				$this->plugin->getServer()->broadcastMessage("§d✿§e EnchantmentUI§d✿§e>§a Bạn §e" . $player->getName() . "§a đã mua id phù phép§e $idenchant §aLevel§e $level");
				$player->sendMessage("§d✿§e EnchantmentUI§d ✿§e>§a Bạn đã mua id phù phép§e $idenchant §aLevel§e $level");
			}else{
				$player->sendMessage("§d✿§e EnchantmentUI§d ✿§e>§c Bạn không có đủ tiền!§e Lưu ý:§a Giá 1 cấp là 1000xu");
			}
	}
}