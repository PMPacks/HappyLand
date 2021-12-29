<?php

namespace CachChoi;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

    public function onEnable() {
  $this->getLogger()->info("Cách Chơi đã Bật");
$this->getLogger()->info("Plugin Thích Hợp Cho Server Nhỏ\nConfig Chat Ở File Config ");
    }


public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
if($cmd->getName() == "cachchoi") {
        $msg = $this->getConfig()->get("cachchoi");
        $msg = str_replace("{LINE}", "\n", $msg);
        $sender->sendMessage($msg);
        }
return true;
    }
       
        
        
        
public function onDisable(){
        $this->getLogger()->info("§cPlugin Cách Chơi Đã Tắt.");
    }
}
