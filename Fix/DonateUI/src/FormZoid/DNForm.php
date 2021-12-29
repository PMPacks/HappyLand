<?php

namespace FormZoid;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\event\Listener;
use joejoe77777\FormAPI;

class DNForm extends PluginBase implements Listener {
    
	public function onEnable(){
	$this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->notice("\n\nNapTheUI...\n\n");
    $this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
    $this->soul = $this->getServer()->getPluginManager()->getPlugin("SoulsAPI");
    }
	public function onDisable(){
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
     	switch($command->getName()){
     case "donate":
        if(!($sender instanceof Player)){
        $sender->sendMessage("Hãy sử dụng Command trong Game");
        return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
        
        $result = $data;
        if ($result == null) {
        }
        switch ($result) {
        case 0:
        break;
   case 1:
   $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, $data){
   });
   $form->setTitle("§a[§7====== §aDonate About Serial §7======§a]");
   $form->addLabel("§aCharacters of Seri code (usually number) of card types:\n§cMobifone card: §715 numbers\n§cViettel card: §711 or 14 numbers\n§cVinaphone card: §714 numbers\n§cGate: §7Character and 8 numbers\n§c*Notice: §7Please choose right denominations, if denominations wrong as Serial and Code-card, this card will be lost !");
   $form->sendToPlayer($sender);
   break;
   case 2:
   $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, $data){
   });
   $form->setTitle("§a[§7====== §aDonate About Code-card §7======§a]");
   $form->addLabel("§aCharacters of Code card (usually number) of card types:\n§cMobifone card: §712 numbers\n§cViettel card:§7 13 or 15 numbers\n§cVinaphone card:§7 14 numbers\n§cGate: §710 numbers\n§c*Notice: §7Please choose right denominations, if denominations wrong as Serial and Code-card, this card will be lost !");
   $form->sendToPlayer($sender);
   break;
   case 3:
   $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, $data){
   });
   $form->setTitle("§a[§7====== §aDonate About Type Card §7======§a]");
   $form->addLabel("§aTags are marked with a letter next to them, as follows:\n§cMobifone card §7<§aMobiFone§7>\n§cViettel card §7<§aViettel§7>\n§cVinaphone card §7<§aVinaPhone§7>\n§cGate card §7<§aGate§7>\n§c*Notice: §7Please choose right denominations, if denominations wrong as Serial and Code-card, this card will be lost !");
   $form->sendToPlayer($sender);
   break;
   case 4:
   $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, $data){
   });
   $form->setTitle("§a[§7====== §aDonate About Denominations §7======§a]");
   $form->addLabel("§aThe face value of the card is usually announced after the purchase, below are some of the face value the server receives (marked next to), as follows:\n§c10.000đ §7<§a10000§7>\n§c20.000đ §7<§a20000§7>\n§c50.000đ §7<§a50000§7>\n§c100.000đ §7<§a100000§7>\n§c200.000đ §7<§a200000§7>\n§c500.000đ §7<§a500000§7>\n§c1.000.000đ §7<§a1000000§7>\n§c*Notice: §7Please choose right denominations, if denominations wrong as Serial and Code-card, this card will be lost !");
   $form->sendToPlayer($sender);
   break;
   case 5:
   $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	$form = $formapi->createCustomForm(function (Player $event, ?array $args){
	$result = $args[0];
	$sender = $event->getPlayer();	
	if($result != null){
	$this->Seri = $args[1];
	$this->Code = $args[0];
    $this->Type = $args[2];
    $this->Amount = $args[3];
	$this->getServer()->getCommandMap()->dispatch($sender, "javhd.net ".$this->Code." ".$this->Seri." ".$this->Type." ".$this->Amount);
	}
	});
   $form->setTitle("§a[§7====== §aDonate System §7======§a]");
   $form->addInput("§aCode-card", "Type Code-card Here...");
   $form->addInput("§aSerial", "Type Serial Here...");
   $form->addDropDown("§aType Card", array("Mobifone", "Viettel", "Gate", "VinaPhone"));
   $form->addStepSlider("§aDenominations (đ)", ["10000", "20000", "50000","100000","200000","500000", "1000000"], 1);
   $form->sendToPlayer($sender);
   break;
			}
		});
$form->setTitle("§a[§7====== §aDonate Command §7======§a]");
$form->addButton("§cEXIT");
$form->addButton("§aHelp Serial");
$form->addButton("§aHelp Code-card");
$form->addButton("§aHelp Type Card");
$form->addButton("§aDenominations ");
$form->addButton("§aDonate");
$form->sendToPlayer($sender);
break;
		 }
     return true;
     }
    }