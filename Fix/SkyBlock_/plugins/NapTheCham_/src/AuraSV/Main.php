<?php

namespace AuraSV;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerJoinEvent;

Class Main extends PluginBase implements Listener{
 
 public $tag = "§l§c[§a NẠP THẺ CHẬM §c] ";
 
 public function onEnable(){
  $this->cf = new Config($this->getDataFolder(). "card.yml", Config::YAML);
  $this->getLogger()->info($this->tag."§b Khởi Chạy");
  }
  public function onJoin(PlayerJoinEvent $event){
	  $player = $event->getPlayer();
	  $count = count($this->cf->getAll());
	  if($player->isOp()){
		  $player->sendMessage($this->tag."§bBạn có §6".$count."§b Cần kiểm tra");
		  
	  }
  }
   public function onCommand(CommandSender $sender, Command $cmd,string $label, array $args):bool{
   switch(strtolower($cmd->getName())){
    case "napthecham":
    $msg = "
§b§l-=-=-=-=-=|§6 NẠP THẺ CHẬM|-=-=-=-=-=
§e•§d /napthecham |Loại thẻ| |Seri| |Pin| |Trị Giá|
§bVD:§d /napthecham viettel 01916196826 8161852715362 100
§aSau khi nạp thẻ, bạn phải đợi admin gạch thẻ,sẽ có point vào tài khoản của bạn...
§6Lưu ý: 
§c Không Spam thẻ sai quá 3 lần: Ban 3 ngày
 Sai mệnh giá thẻ mất thẻ + Ban(3 ngày)

§aChỉ Nhận Thẻ:§e viettel | zing | mobi | vina
§6Ưu tiên:
§a+ Zing: 20 trở lên
§6Chờ Lâu:
§a+ Các loại thẻ còn lại [20 trở lên]
 ";
    if(!(isset($args[0])||isset($args[1]) || isset($args[2]) || isset($args[3]))){
    
 $sender->sendMessage($msg);
   return true;
   }
   if(!(is_numeric($args[1]) || is_numeric($args[2]) || is_numeric($args[3]))){
      $sender->sendMessage($this->tag."§b |§a Mã Thẻ, Seri, Giá trị §b|§6 phải là số");
    return true;
   }
 if(($args[0] == "viettel" || $args[0] == "zing")){
 $sender->sendMessage($this->tag."§eNhà mạng này hiện đang bảo trì, 
§aHOẠT ĐỘNG TỐT:
§6 + zing
§6 + viettel
 ");
$this->cf->set( $sender->getName(), ["LoaiThe" => $args[0], "Seri" =>  $args[1] , "Pin" => $args[2], "TriGia" => $args[3]]);
$this->cf->save();
$sender->sendMessage($this->tag."§a Đã gửi thẻ, vui lòng chờ");
    break;
    return true;
   
   }
   break;
      case "cards":
   if($sender->isOp()){
	   $count = count($this->cf->getAll());
	   $sender->sendMessage($this->tag."§b bạn có §6".$count."§b card cần kiểm tra");
	   
   }
   break;
   }
   return true;
   }
}