<?php
namespace NapThe\Commands;
use NapThe\NapThe;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerJoinEvent;
class KttkCommand extends PluginBase implements Listener {
    public function execute(NapThe $plugin, CommandSender $sender, $label, array $args):bool{
        $amount = $plugin->api->look($sender->getName());
        $sender->sendMessage($plugin->prefix."§eTài khoản của bạn hiện có ".$amount . " Points.");
        return true;
    }
	
}


