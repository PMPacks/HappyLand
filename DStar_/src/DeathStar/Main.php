<?php
/**
   * Author: Khang
   * Edit Từ EconomyAPIUI
   * Thích Làm Cc Gì Làm :v
   * DeathStar MCBE
   */

declare(strict_types=1);


namespace DeathStar;

use Frago9876543210\EasyForms\elements\{Dropdown, Slider, Element, Label};
use Frago9876543210\EasyForms\forms\CustomForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\{command\ConsoleCommandSender, Server, Player, utils\TextFormat};
use pocketmine\plugin\PluginBase;
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getLogger()->Info("§aĐã Bật Menu Star Của Server \n•\n•\n•\n•\n•\n•\n•\n•\n•\n §e Làm Lại Từ UI Của Economy!");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "dstar":
			$this->mainForm($player);
        }
        return true;
    }
	
	public function mainForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createSimpleForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				if(isset($data[0])){
					switch($data[0]){
						case 0:
						$command = "star";
					    $this->getServer()->getCommandMap()->dispatch($sender, $command);
						break;
						case 1:
						$this->paystarForm($player);
						break;
						case 2:
						$this->getServer()->getCommandMap()->dispatch($player, "topstar");
						break;
						case 3:
						$this->viewstarForm($player);
						break;
						case 4;
						$this->listec($player);
						break;
						case 5;
						$this->enchant($player);
					}
				}
			});
			$form->setTitle("§l§eStar §bMenu");
			$form->setContent("§o§aHãy Chọn Command!");
			$form->addButton("§l§6 Số Star Của Bạn");
			$form->addButton("§l§6 Chuyển Star Cho Người Khác");
			$form->addButton("§l§6 Top Star Server");
			$form->addButton("§l§6 Xem Star Của Người Khác");
			$form->addButton("§l§6 List Enchant");
			$form->addButton("§l§6 Mua Enchant");
			$form->sendToPlayer($player);
		}
	}
	
	public function paystarForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$result = $data[0];
				if($result != null){
					$this->playerName = $data[0];
					$this->starPay = $data[1];
					$this->getServer()->getCommandMap()->dispatch($player, "paystar " . $this->playerName . $this->statPay);
				}
			});
			$form->setTitle("§l§bGửi §eStar §b Đến Người Khác");
			$form->addInput("§oChọn Tên Người Chơi Và\n Số Star Để Pay");
			$form->sendToPlayer($player);
		}
	}
	
	public function viewstarForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$result = $data[0];
				if($result != null){
					$this->playerNamer = $data[0];
					$this->getServer()->getCommandMap()->dispatch($player, "viewstar " . $this->playerNamer);
				}
			});
			$form->setTitle("§l§bXem §eStar §bCuad Người Khác");
			$form->addInput("§oChọn Tên ");
			$form->sendToPlayer($player);
		}
	}
	
	public function listec($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				if(isset($data[0])){
					switch($data[0]){
						case 0:
						$this->mainForm($player);
						break;
					}
				}
			});
			$form->setTitle("§aＬＩＳＴ ＩＤ ＥＮＣＨＡＮＴＭＥＮＴ");
			$form->addLabel("§aPROTECTION = 0\n§aFIREPROTECTION = 1\n§aFALLPROTECTION = 2\n§aEXPLOSIONPROTECTION = 3\n§aPROJECTILEPROTECTION = 4\n§aTHORNS = 5\n§aBREATHING = 6\n§aSPEED = 7\n§aAFFINITY = 8\n§aSHARPNESS = 9\n§aSMITE = 10\n§a ARTHROPODS = 11\n§aKNOCKBACK = 12\n§aFIREASPECT = 13\n§aLOOTING = 14\n§aEFFICIENCY = 15\n§aSILKTOUCH = 16\n§aDURABILITY = 17\n§aFORTUNE = 18\n§aPOWER = 19\n§aKNOCKBACK = 20\n§aFLAME = 21\n§aINFINITY = 22\n§aINGFORTUNE = 23\n§aINGLURE = 24");
			$form->addButton("§eBack");
		}
	}
	
	public function enchant($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$slider = $form->addSlider("§aLevel",1,5);
				$this->id = $data[0];
				$data[1] = $slider; 
				if(isset($data[0])){
					switch($data[0]){
						case 0:
						$this->getServer()->getCommandMap()->dispatch("buyec ".$player, $this->id, $slider);
						break;
					}
				}
			});
			$form->setTitle("§dＥＮＣＨＡＮＴＭＥＮＴ");
			$form->addLabel("§oVui Lòng Cầm Vật Phẩm Trên Tay Trước Khi Enchant, Giá Mỗi Level = 5000$");
			$form->addInput("§aID Enchantment");
		}
	}		
}