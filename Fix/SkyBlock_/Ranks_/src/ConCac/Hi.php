<?php


/*
 * Nhìn Cặc
 * Nhìn Cặc
 * Nhìn Cặc
 *
 */
namespace ConCac;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\Server;

class Hi extends PluginBase implements Listener{
 public $pre = "§7[ §aRank§7 ]§r ";
    public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
       $this->coin = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
        $this->getLogger()->info("§l§bPlugin Ranks Đã Bật");
    }
		 public function onCommand(CommandSender $sender,Command $cmd,string $label,array $args):bool {
			 if(!$sender instanceof Player){
				 $sender->sendMessage("§7Vui lòng sử dụng lệnh trong Game");
				 return true;
			 }
			 if($cmd->getName() == "muavip"){
				 $mypoint = $this->coin->myMoney($sender->getName());
				 /*  HIHIHHIHIHIHI */
				   /* ADD FORM */


		 $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    			 if($api === null || $api->isDisabled()){
                        }
        $form = $api->createSimpleForm(function (Player $sender, array $data){
            $result = $data;
            if ($result == null) {
				return true;
            }
            switch ($result) {
				case 0:
				$player = $sender;
		    	$this->PermForm($player);
				return;
                   case 1:
				  
      $gia = 10;
      $gr = "VIP1";
      $day = 7;
      if($this->coin->myMoney($sender->getName()) >= $gia){
      $this->getServer()->broadcastMessage($this->tag."§e".$sender->getName()."§a Mua thành công§e ".$gr);
      $this->coin->reduceMoney($sender->getName(), $gia);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip ".$sender->getName()." ".$gr." ".$day);
      $sender->sendMessage($this->tag."§b Mua Thành Công§e ".$gr);
      }else{
      $sender->sendMessage($this->tag."§cKhông đủ Point");
     }
				  return;
				   case 2:
				     $gia = 30;
      $gr = "VIP2";
      $day = 20;
      if($this->coin->myMoney($sender->getName()) >= $gia){
      $this->getServer()->broadcastMessage($this->tag."§e".$sender->getName()."§a Mua thành công§e ".$gr);
        $this->coin->reduceMoney($sender->getName(), $gia);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip ".$sender->getName()." ".$gr." ".$day);
      $sender->sendMessage($this->tag."§b Mua Thành Công§e ".$gr);
      }else{
      $sender->sendMessage($this->tag."§cKhông đủ Point");
     }
				   return;
				   case 3:
				        $gia = 80;
      $gr = "VIP3";
      $day = 50;
      if($this->coin->myMoney($sender->getName()) >= $gia){
      $this->getServer()->broadcastMessage($this->tag."§e".$sender->getName()."§a Mua thành công§e ".$gr);
      $this->coin->reduceMoney($sender->getName(), $gia);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip ".$sender->getName()." ".$gr." ".$day);
      $sender->sendMessage($this->tag."§b Mua Thành Công§e ".$gr);
      }else{
      $sender->sendMessage($this->tag."§cKhông đủ Point");
     }
				 return;
				   case 4:
				   				    $gia = 200;
      $gr = "VIP4";
      $day = 100;
      if($this->coin->myMoney($sender->getName()) >= $gia){
      $this->getServer()->broadcastMessage($this->tag."§e".$sender->getName()."§a Mua thành công§e ".$gr);
  $this->coin->reduceMoney($sender->getName(), $gia);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip ".$sender->getName()." ".$gr." ".$day);
      $sender->sendMessage($this->tag."§b Mua Thành Công§e ".$gr);
      }else{
      $sender->sendMessage($this->tag."§cKhông đủ Point");
     }
				return;
				   case 5:
					       case "vip5":
        $gia = 400;
      $gr = "VIP5";
      $day = 250;
      if($this->coin->myMoney($sender->getName()) >= $gia){
      $this->getServer()->broadcastMessage($this->tag."§e".$sender->getName()."§a Mua thành công§e ".$gr);
        $this->coin->reduceMoney($sender->getName(), $gia);
      $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip ".$sender->getName()." ".$gr." ".$day);
      $sender->sendMessage($this->tag."§b Mua Thành Công§e ".$gr);
      }else{
      $sender->sendMessage($this->tag."§cKhông đủ Point");
     }
			return;
			}
		});
			$form->setTitle("§l§f• §1MUA VIP §f•");
			$form->setContent("§l§aPoint của bạn:§e ".$mypoint);
			$form->addButton("§l§0♣§c Quyền Lợi - Giá §0♣",1,"https://png.icons8.com/ultraviolet/160/approval.png");
			$form->addButton("§l§d♥ §eVIP 1 §d♥",1,"http://img.zing.vn/volamthuphi/images/data/event2015/vip1.png");
			$form->addButton("§l§d♥ §eVIP 2 §d♥",1,"http://img.zing.vn/volamthuphi/images/data/event2015/vip2.png");
			$form->addButton("§l§d♥ §eVIP 3 §d♥",1,"http://img.zing.vn/volamthuphi/images/data/event2015/vip3.png");
			$form->addButton("§l§d♥ §eVIP 4 §d♥",1,"http://img.zing.vn/volamthuphi/images/data/event2015/vip4.png");
			$form->addButton("§l§d♥ §eVIP 5 §d♥",1,"http://img.zing.vn/volamthuphi/images/data/event2015/vip5.png");
			$form->sendToPlayer($sender);
		
				
			 }
			 return true;
		 }
		 public function PermForm(Player $player){
			   $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
     	 if($api === null || $api->isDisabled()){
                        }
        $form = $api->createSimpleForm(function (Player $sender, array $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
				case 0:
			//1
	    $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $player, array $data){
		});
			
		$form->setTitle("§l§a→ §6Permission §a←");
		$form->addLabel("§l§6VIP 1:");
		$form->addLabel("§l§bGiá:§e 5 §cPoint");
		$form->addLabel("§l§bSố Ngày: §d3");
		$form->addLabel("§l§f•§5 Quyền Lệnh§f •");
		$form->addLabel("§l§0→ §c/fly:§a Đễ bay");	
        $form->sendToPlayer($player);
return;
case 1:
$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $player, array $data){
		});
			
		$form->setTitle("§l§a→ §6Permission §a←");
		$form->addLabel("§l§6VIP 2:");
		$form->addLabel("§l§bGiá:§e 20 §cPoint");
		$form->addLabel("§l§bSố Ngày: §d7");
		$form->addLabel("§l§f•§5 Quyền Lệnh§f •");
		$form->addLabel("§l§0→ §c/fly:§a Đễ bay");
		$form->addLabel("§l§0→ §c/tp:§a Dịch chuyển");
        $form->sendToPlayer($player);
return;
		case 2:
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $player, array $data){
		});
			
		$form->setTitle("§l§a→ §6Permission §a←");
		$form->addLabel("§l§6VIP 3:");
		$form->addLabel("§l§bGiá:§e 50 §cPoint");
		$form->addLabel("§l§bSố Ngày: §d30");
		$form->addLabel("§l§f•§5 Quyền Lệnh§f •");
		$form->addLabel("§l§0→ §c/fly:§a Đễ bay");
		$form->addLabel("§l§0→ §c/tp:§a Dịch chuyển");
		$form->addLabel("§l§0→ §c/time:§a Điều chỉnh thời gian");
		$form->addLabel("§l§0→ §c300.000 §bYên");
        $form->sendToPlayer($player);
return;
		case 3:
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $player, array $data){
		});
			
		$form->setTitle("§l§a→ §6Permission §a←");
		$form->addLabel("§l§6VIP 4:");
		$form->addLabel("§l§bGiá:§e 100 §cPoint");
		$form->addLabel("§l§bSố Ngày: §d50");
		$form->addLabel("§l§f•§5 Quyền Lệnh§f •");
		$form->addLabel("§l§0→ §c/fly:§a Đễ bay");
		$form->addLabel("§l§0→ §c/tp:§a Dịch chuyển");
		$form->addLabel("§l§0→ §c/fix: §bFree Sửa chữa vật phẩm");
		$form->addLabel("§l§0→ §c400.000§a Yên");
        $form->sendToPlayer($player);
return;
		case 4:
				$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $player, array $data){
		});
			
		$form->setTitle("§l§a→ §6Permission §a←");
		$form->addLabel("§l§6VIP 4:");
		$form->addLabel("§l§bGiá:§e 100 §cPoint");
		$form->addLabel("§l§bSố Ngày: §d50");
		$form->addLabel("§l§f•§5 Quyền Lệnh§f •");
		$form->addLabel("§l§0→ §c/fly:§a Đễ bay");
		$form->addLabel("§l§0→ §c/tp:§a Dịch chuyển");
		$form->addLabel("§l§0→ §c/fix: §bFree Sửa chữa vật phẩm");
		$form->addLabel("§l§0→ §c/kick: §aKick người chơi vi phạm");
	    
		$form->addLabel("§l§0→ §c500.000§a Yên");
        $form->sendToPlayer($player);
				 }
		});

		$form->setTitle("§l§f• §1Permisson VIP §f•");
			
			
			$form->addButton("§l§d♥ §eVIP 1 §d♥",1,"http://img.zing.vn/volamthuphi/images/data/event2015/vip1.png");
			$form->addButton("§l§d♥ §eVIP 2 §d♥",1,"http://img.zing.vn/volamthuphi/images/data/event2015/vip2.png");
			$form->addButton("§l§d♥ §eVIP 3 §d♥",1,"http://img.zing.vn/volamthuphi/images/data/event2015/vip3.png");
			$form->addButton("§l§d♥ §eVIP 4 §d♥",1,"http://img.zing.vn/volamthuphi/images/data/event2015/vip4.png");
			$form->addButton("§l§d♥ §eVIP 5 §d♥",1,"http://img.zing.vn/volamthuphi/images/data/event2015/vip5.png");
			$form->sendToPlayer($player);
		}
		}
			 
				 
