<?php

namespace NghiaNP;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\{Command,CommandSender,ConsoleCommandSender};
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
	}
	
	public function onCommand(CommandSender $s, Command $cmd, string $label, array $args) : bool {
		$player = $s->getPlayer();
		if($cmd->getName () == "buyecui"){
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
						$this->listec($player);
						break;
						case 1:
						$this->enchant($player);
					}
				}
			});
			$form->setTitle("§eＢＵＹ §5ＥＮＣＨＡＮＴ");
			$form->setContent("§b§oHãy Ấn 1 Tùy Chọn Bất Kì");
			$form->addButton("§aＬＩＳＴ ＩＤ ＥＮＣＨＡＮＴＭＥＮＴ",1,"http://shopgaming.net/img/uploads/kiem-minecraft-vang-0.jpg");
			$form->addButton("§dＥＮＣＨＡＮＴＭＥＮＴ",1,"https://art.pixilart.com/04717e616c3cdc0.png");
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
						$this->getServer()->getCommandMap()->dispatch("enchant ".$player, $this->id, $slider);
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