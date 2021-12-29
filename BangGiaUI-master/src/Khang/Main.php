<?php

namespace Khang;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener {
	
    public function onEnable(){
        $this->getLogger()->info("§a Bảng Giá Của Server!!");
	$this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
	
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        $player = $sender->getPlayer();
	switch($command->getName()){
           case "banggia":
           $this->mainForm($player);
        }
        return true;
    }
	
    public function mainForm($player): void {
        $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	$form = $formapi->createCustomForm(function (Player $player, $data){
           $result = $data[0];
	});
	$form->setTitle("§l§c Bảng Giá ");
	$form->addLabel("§f§l| §eVIP-I §f|§a: §b- 10k/3 day\n-20k/7 day + Kit VIP-I");
	$form->addLabel("§f§l| §eVIP-II §f|§a: §b- 50k/30 day\n+ Kit VIP-II,Fly (no fly in prison)");
	$form->addLabel("§f§l| §eVIP-III §f|§a: §b- 100k/45 day\n+ Kit VIP-III,Fly,Telerport,nick,...");
	$form->addLabel("§f§l| §eVIP-IV  §f|§a: §b- 200k/90 day\n+ Kit VIP-IV,Fly,\nTelerport,Nick,§6Gamemode...");
	$form->addLabel("§eMua Liên Hệ Fb:fb.com/0x1x2x0x Để Nạp và được khuyến mãi!!");
	$form->sendToPlayer($player);
    }
}
			
