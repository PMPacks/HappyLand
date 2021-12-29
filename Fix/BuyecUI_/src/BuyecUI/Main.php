<?php

namespace BuyecUI;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\event\Listener;
class Main extends PluginBase implements Listener
{
public function onEnable()
   {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
       $this->getLogger()->notice("Plugin Loading...");

     $this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
     $this->getLogger()->info("§l§c>§b BuyEnchant");
     }
     public function onDisable(){
     $this->getLogger()->info("§c>§b Buy Enchant : Disable");
 }
     public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
         switch($cmd->getName()){
			 case "buyecui":
			  if(!($sender instanceof Player)){
                $sender->sendMessage("§7This command can't be used here. Sorry!");
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                   case 0:
                   $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, array $data){
   });
   $form->setTitle("§aＬＩＳＴ ＩＤ ＥＮＣＨＡＮＴＭＥＮＴ");
      $form->addLabel("0:Bảo vệ");
   $form->addLabel("1:Bảo vệ khỏi lửa");
   $form->addLabel("2:Rơi nhẹ như long chim");
   $form->addLabel("3:Bảo vệ khỏi vụ nổ");
   $form->addLabel("4:Bảo vệ khỏi vật được bắn");
   $form->addLabel("5:Gai");
   $form->addLabel("6:Hô hấp");
   $form->addLabel("7:Sải chân dưới nước");
   $form->addLabel("8:Áp lực với nước");
   $form->addLabel("9:Sắc bén");
   $form->addLabel("10:Hại thây ma");
   $form->addLabel("11:Hại chân đốt");
   $form->addLabel("12: Bật lùi");
   $form->addLabel("13: Khía cạnh của lửa");
   $form->addLabel("14:Nhặt");
   $form->addLabel("15:Hiệu xuất");
   $form->addLabel("16:Mềm mại");
   $form->addLabel("17:Không bị phá vở");
   $form->addLabel("18:Gia tài");
   $form->addLabel("19:Sứch Mạnh");
   $form->addLabel("20:Đấm");
   $form->addLabel("21:Lửa");
   $form->addLabel("22:Vô Hạn");
   $form->addLabel("23:May mắn");
   $form->addLabel("24:Nhử");
   $form->sendToPlayer($sender);
   break;
   case 1:
   $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $event, array $args){
								              $result = $args[0];
											$sender = $event->getPlayer();	
				if($result != null){
					$this->ID = $args[0];
					$this->Level = $args[1];
					 $this->getServer()->getCommandMap()->dispatch($sender, "buyec ".$this->ID." ".$this->Level);
			}
		});
   $form->setTitle("§eＢＵＹ §5ＥＮＣＨＡＮＴ");
   $form->addStepSlider("§l§aChọn ID Enchant", ["0", "1", "2","3","4","5","6","7","8","9","10","11","12","13", "14", "15", "16", "17", "18", "19", "20", "21", "22","23","24"], 1);
  // $form->addInput("§a§l Nhập ID Enchant", "15");
   //$form->addInput("§a§l Nhập Level", "1 - 5");
   $form->addStepSlider("§bChọn Level§6", ["1", "2", "3", "4", "5"], 1);
   $form->sendToPlayer($sender);
   break;
			}
		});
$form->setTitle("§dＥＮＣＨＡＮＴＭＥＮＴ");
$form->setContent("§a§l20.000 Xu §b/ 1 Level
§l§6Max§a 5 §6Level");
$form->addButton("§l§bLIST ID ENCHANT");
$form->addButton("§l§aBUY ENCHANT");
$form->addButton("§l§cEXIT");
$form->sendToPlayer($sender);
break;
		 }
     return true;
     }
   }

    