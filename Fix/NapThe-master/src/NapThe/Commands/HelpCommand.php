<?php
namespace NapThe\Commands;

use NapThe\NapThe;
use pocketmine\command\CommandSender;

class HelpCommand extends PluginBase implements Listener {
    public function execute(NapThe $plugin, CommandSender $sender, $label, array $args):bool{
        $sender->sendMessage($plugin->prefix."§a/napthe napthe <vina | mobi | viettel | vtc | gate> <series> <pincode> §eđể nạp thẻ");
        $sender->sendMessage($plugin->prefix."§a/napthe kttk §eđể kiểm tra số points trong tài khoản");
        $sender->sendMessage($plugin->prefix."§a/napthe muarank <1 | 2 | 3 | 4 | 5 | 6> §eđể nâng rank tương ứng");
        $sender->sendMessage($plugin->prefix."§a/napthe doixu <số xu> §eđể đổi từ points sang §eGold");
        return true;
    }
}

