<?php
namespace NapThe\Commands;
use NapThe\NapThe;
use pocketmine\command\CommandSender;
use onebone\economyapi\EconomyAPI;

class DoiXuCommand extends PluginBase implements Listener {
    public function execute(NapThe $plugin, CommandSender $sender, $label, array $args):bool{
        if (!isset($args[1])) return $plugin->registeredCommands['help']->execute($plugin, $sender, $label, $args);
        if ($plugin->api->take($sender->getName(), abs(intval($args[1])))){
            $plugin->eco->addMoney($sender->getName(), abs(intval($args[1]))*450);
            $sender->sendMessage($plugin->prefix."§aBạn đã đổi thành công ".abs(intval($args[1]))." Points thành ".abs(intval($args[1]))*450 ." Gold");
            return true;
        } else {
            $sender->sendMessage($plugin->prefix."§cCó gì đó sai, kiểm tra nào");
            return false;
        }
        return false;
    }
}

