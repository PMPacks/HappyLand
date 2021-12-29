<?php
namespace DeathStar\Star;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\utils\Config;

use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;


class Main extends PluginBase implements Listener{
    public function onEnable(){
        $this->getServer()->getLogger()->info("§aStar Đang Chạy - Bật ~~~\n.\n.\n.\n.\n.\n.\n.\n.\n.\n.\nPlugin Đã Làm Lại Từ Economy?");

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        
		$this->cmd = new Config($this->getDataFolder(). "commands.yml", Config::YAML, [
		"star" => "Để xem star của bạn",
		"setstar" => "Đặc số star của người chơi",
		"givestar" => "Thêm star cho người chơi",
		"restar" => "Xóa star của người chơi",
		"topstar" => "Xem xếp hạng star của máy chủ",
		"viewstar" => "Xem star của người chơi",
		"paystar" => "chuyển star cho người chơi khác",
		]);
		$this->cmd->save();
    }
    public function onJoin(PlayerJoinEvent $ev){
		        $player = $ev->getPlayer()->getName();
		$check = new Config($this->getDataFolder()."star.yml",Config::YAML);
		$mn = $check->get(strtolower($player));
        if($mn == null){
			$this->getLogger()->notice(" Không Tìm Thấy Dữ liệu $player");
			$this->getLogger()->notice(" Tạo Dữ liệu ".strtolower($player).".yml");
        $this->money = new Config($this->getDataFolder()."star.yml",Config::YAML, [
            strtolower($player) => 0,
        ]);
        $this->money->save();
		}
        }
        public function setStar($player, $star){
        	if($player instanceof Player){
        	$player = $player->getName();
        }
        $player = strtolower($player);
              	$all = new Config($this->getDataFolder()."star.yml",Config::YAML);
			$all->set($player, $star);
			$all->save();
        	}
		
        public function getAllStar(){
        	$all = new Config($this->getDataFolder()."star.yml",Config::YAML);
			
        	return $all->getAll();
        	}
       public function viewStar($player){
       $star = $this->myStar($player);
          return $star;
       	
       	}
		public function addStar($player, int $star){
		if($player instanceof Player){
				$player = $player->getName();
		
			}
			$player = strtolower($player);
			
			$this->setStar($player, $this->myStar($player) + $star);
		}
		public function removeStar($player, int $star){
			if($player instanceof Player){
				$player = $player->getName();
			}
			if($this->myStar($player) - $star < 0){
				return true;
			}
			$player = strtolower($player);
			$money = new Config($this->getDataFolder()."star.yml",Config::YAML);
			$money->set($player, (int)$money->get($player) -$star);
			$money->save();
		}
		public function myStar($player){
			if($player instanceof Player){
				$player = $player->getName();
			}
			$player = strtolower($player);
			$money = new Config($this->getDataFolder()."star.yml",Config::YAML);
			$money->get($player);
			return $money->get($player);
		}
		public function payStar($player, $target, $star){
			if($player instanceof Player){
				$myp = $this->myStar($player);
				$myt = $this->myStar($target);
				
				$this->removeStar($player, $star);
				$this->addStar($target, $star);
				}
			}
        public function onCommand(CommandSender $sender, Command $command, $label, array $args):bool{
            switch($command->getName()){
            	case "paystar":
            if($sender instanceof Player){
            $player = $this->getServer()->getPlayer($args[0]);
            if(isset($args[0]) || isset($args[1])){
            $this->payStar($sender, $player, $args[1]);
            }else{
            	$sender->sendMessage("§l§b[Star]§6 để chuyển star sử dụng lệnh: §d/paystar <player> <số star>");
            	}
           }
   break;
                case "star":
             $star = $this->myStar($sender);
             $sender->sendMessage("§l§b[DeathStar]§6 Star hiện có :§a ".$star);
                         break;
                case "setstar":
				if(!isset($args[1])){
					$sender->sendMessage("§cStar Hoặc Player không chính xác");
					return true;
				}
				if(!is_numeric($args[1])){
					$sender->sendMessage("§cĐơn Vị Này phải là số!");
					return true;
				}
                    $player = $this->getServer()->getPlayer($args[0]);
                    $this->setStar($player, $args[1]);
                      break;
                case "givestar":
				if(!isset($args[1])){
					$sender->sendMessage("§cStar Hoặc Player không chính xác!");
					return true;
				}
				if(!is_numeric($args[1])){
					$sender->sendMessage("§cStar phải là số!");
					return true;
				}
                    $player = $this->getServer()->getPlayer($args[0]);
			
                      if(!isset($args[1])){
                        $sender->sendMessage("§7Use§8:§a /givestar <nick> <star>");
                        return true;
                    }
                   
                    //$this->addCoin(strtolower($player), $args[1]);
					$them = $this->myStar($player) + $args[1];
                    $this->setStar($player, $them);
                    $sender->sendMessage("§7Đã cho §a".$args[1] ." star §7đến §a".$args[0]."");
                    $sender->sendMessage("§7Tổng số Star của: §a".$args[0]." §7Là:§a ".$this->myStat($player));
					
					if($sender instanceof Player){
                    $player->sendMessage("§7Đã thêm §a".$args[1]." Star vào tài khoản của bạn , Để xem sử dụng: §a/star");
					}
					
					break;
                case "restar":
				if(!isset($args[1])){
					$sender->sendMessage("§cStar hoặc Nick không được định nghĩa!");
					return true;
				}
				if(!is_numeric($args[1])){
					$sender->sendMessage("§cStar phải là số!");
					return true;
				}
                    $player = $this->getServer()->getPlayer($args[0]);
					
                    $money = $this->myStar($player);
                    if($money > $args[1]){
                    $this->setStar($player, $money - $args[1]);
                    $sender->sendMessage("§7Đã xóa§a ".$args[1] ." Star §7Của Player: §a".$args[0]."");
                    $sender->sendMessage("§7Star của player§a ".$args[0]." §7Đã thay đỏi thành:§a ".$this->myStar($player));
					if($sender instanceof Player){
                    $player->sendMessage("§7Đã xóa §a".$args[1]." Star§7 từ Tài khoản của bạn");
					}
            }
            break;
            case "topstar":
			$max = 0;
				$max += count($this->getAllStar());
				$max = ceil(($max / 5));
				$page = array_shift($args);
				$page = max(1, $page);
				$page = min($max, $page);
				$page = (int)$page;
				$sender->sendMessage("§c§l♦§a --------§e Đua Top Star (Nạp Thẻ) (§c".$page."/".$max."§e)§a --------§c♦");
				$aa = $this->getAllStar();
				arsort($aa);
				$i = 0;
				foreach($aa as $b=>$a){
				if(($page - 1) * 5 <= $i && $i <= ($page - 1) * 5 + 4){
				$i1 = $i + 1;
				$a = (int)$a;
				$sender->sendMessage("§c♦§e Hạng §a".$i1."§e là§d ".$b."§e với§c ".$a." Star");
				}
				$i++;
				}
			break;
           /* $moneyall = $this->getAllCoin();
if(count($moneyall) > 0){
arsort($moneyall);
$i = 1;
foreach($moneyall as $name => $money){
$sender->sendMessage("§l§e|=====|§a XẾP HẠNG COIN §e|=====|");
$sender->sendMessage("§7[ §a$i §7]§b $name §6|§b $money");
if($i > 6){
break;
}
$i++;
}
}else{
	$sender->sendMessage("§l§b[ACOIN]§6 Số người chơi server phải hơn §b0");
}*/
            break;
            case "viewstar":
            if(!isset($args[0])){
            	$sender->sendMessage(" Nhập Tên Người chơi: /viewstat [name]");
            	}
            $player = $this->getServer()->getPlayer($args[0]);
            	if($player == null){
            	
            $view = $this->viewStar($player);
            $sender->sendMessage("§l§bSố star của §6".$args[0]."§b :§6".$view);
            }
            }
			return true;
           }
		   
        }