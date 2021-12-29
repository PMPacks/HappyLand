<?php
declare(strict_types=1);
namespace SizePLayer;
use pocketmine\{
  Server, Player
};
use pocketmine\command\{
  Command, CommandSender
};
use pocketmine\utils\TextFormat as TF;
use pocketmine\entity\Entity;
  
class SizePLayerCommand extends Command {
    
    /** var Plugin */
    private $plugin;
  
    public function __construct($plugin) {
        $this->plugin = $plugin;
        parent::__construct("size", "Change your player size!");
    }
    
    public function execute(CommandSender $player, string $label, array $args){
        if(!$player instanceof Player){
			$player->sendMessage(TF::RED."This command only works in-game");
			return;
		}
        if($player->hasPermission("size.command")) {
            if(isset($args[0])) {
                if(is_numeric($args[0])) {
                    if($args[0] > 15) {
                      $player->sendMessage(TF::RED. "§cKích cỡ phải không được lớn hơn §e15");
                      return true;
                    }elseif($args[0] <= 0) {
                      $player->sendMessage(TF::RED. "§cKích cỡ không được nhỏ hơn §e0§c hoặc âm §e0");
                      return true;
                    }
                    $this->plugin->size[$player->getName()] = $args[0];
                    $player->setScale((float)$args[0]);
                    $player->sendMessage("§aBạn đã chỉnh kích cỡ của cơ thể thành ".TF::GOLD . $args[0]."§a!");
                }elseif($args[0] == "reset") {
                    if(!empty($this->plugin->size[$player->getName()])) {
                        unset($this->plugin->size[$player->getName()]);
                        $player->setScale(1);
                        $player->sendMessage("§aKích cỡ của bạn đã trở lại bình thường");
                    }else{
                        $player->sendMessage("§aBạn đã đặt lại kích cỡ!");
                    }
                }else{
                    $player->sendMessage("§a» §eCác câu lệnh! Sizeplayer \n§a» §b/size help §7 - Nếu bạn không biết lệnh!\n§a» §b/size reset §7 - Đặt lại kích cỡ cơ thể!\n§a» §b/size (kích cỡ) §7 - Chỉnh kích cỡ!");
                }
            } else {
              $player->sendMessage(TF::RED. "§cKích cỡ phải là một số hợp lệ!");
            }
            return true;
        }
        $player->sendMessage(TF::RED. "§cBạn không có quyền để sử dụng các câu lệnh của /size!");
    }
}
