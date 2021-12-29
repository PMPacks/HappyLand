<?php

declare(strict_types=1);

namespace RankShop;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use jojoe77777\FormAPI;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\server\ServerCommandEvent;
use pocketmine\Player;
use pocketmine\Server;
use onebone\economyapi\EconomyAPI;
use RankShop\Main;

class Main extends PluginBase implements Listener{
     public $tag = "§7[ §aRank§7 ]§r ";
    public function onEnable(){
        $this->getLogger()->info("§aStarting RankShopUI plugin...");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->coin = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
		
		@mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
    }

    public function checkDepends(){
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->error("§4Please install FormAPI Plugin, disabling RankShopUI plugin...");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
        if($cmd->getName() == "rankshop"){
        if(!($sender instanceof Player)){
                $sender->sendMessage("§cPlease use this command from In-game!", false);
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
				//	$this->PermForm($sender);
            //        $sender->sendMessage($this->getConfig()->get("cancelled"));
                        break;
                    case 1:
                    $this->rank1($sender);
                        break;
                    case 2:
                    $this->rank2($sender);
                        break;
                    case 3:
                    $this->rank3($sender);
                        break;
                    case 4:
                    $this->rank4($sender);
                        break;
                    case 5:
                    $this->rank5($sender);
                        //break;
                  /*  case 6:
                    $this->rank6($sender);
                        break;
                   case 7:
                    $this->rank7($sender);
                        break;
                    case 8:
                    $this->rank8($sender);
                        break;
                    case 9:
                    $this->rank9($sender);
                        break;
                    case 10:
                    $this->rank10($sender);*/
                        break;
            }
        });
     $form->setTitle("§l§f• §1MUA VIP §f•");
			$form->setContent("§l§aPoint của bạn:§e ".$this->coin->myMoney($sender->getName()));
		$form->addButton("§l§cTHOÁT", 0);
			//$form->addButton("§l§0♣§c Quyền Lợi - Giá §0♣",0,"https://sb-bg.com/app/uploads/2016/04/icon-information.png");
			$form->addButton("§l§d♥ §eVIP 1 §d♥",1,"http://img.zing.vn/volamthuphi/images/data/event2015/vip1.png");
			$form->addButton("§l§d♥ §eVIP 2 §d♥",2,"http://img.zing.vn/volamthuphi/images/data/event2015/vip2.png");
			$form->addButton("§l§d♥ §eVIP 3 §d♥",3,"http://img.zing.vn/volamthuphi/images/data/event2015/vip3.png");
			$form->addButton("§l§d♥ §eVIP 4 §d♥",4,"http://img.zing.vn/volamthuphi/images/data/event2015/vip4.png");
			$form->addButton("§l§d♥ §eVIP 5 §d♥",5,"http://img.zing.vn/volamthuphi/images/data/event2015/vip5.png");
			$form->sendToPlayer($sender);
        }
        return true;
    }

    public function rank1($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
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
                        break;
                    case 2:
             //  $sender->sendMessage($this->getConfig()->get("rank1.cancelled"));
                        break;
            }
        });
		$gia = 10;
      $gr = "VIP1";
        $form->setTitle("§l§aVIP 1");
        $form->setContent("§l§a Bạn có chắc mua§6 ".$gr."§a với giá §6".$gia." Point
§b ⇨ §e Quyền Lợi VIP-1:".
"§a » §b Fly [/fly {Người chơi}]");
	   
        $form->setButton1("§l§6MUA", 1);
        $form->setButton2("§l§cTHOÁT", 2);
        $form->sendToPlayer($sender);
    }

    public function rank2($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
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
                        break;
                    case 2:
              // $sender->sendMessage($this->getConfig()->get("rank2.cancelled"));
                        break;
            }
        });
		$gr = "VIP2";
		  $gia = 30;
      $day = 20;
               $form->setTitle("§l§aVIP 2");
        $form->setContent("§l§a Bạn có chắc mua§6 ".$gr."§a với giá §6".$gia." Point".
		"§b ⇨ §e Quyền Lợi VIP-2:"
."§a » §b Fly [/fly {Người Chơi} ]"
."§a » §b Teleport [/tp]");
	   
        $form->setButton1("§l§6MUA", 1);
        $form->setButton2("§l§cTHOÁT", 2);
        $form->sendToPlayer($sender);
    }

    public function rank3($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
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
                        break;
                    case 2:
            //   $sender->sendMessage($this->getConfig()->get("rank3.cancelled"));
                        break;
            }
        });
		 $gia = 80;
      $gr = "VIP3";
      $day = 50;
               $form->setTitle("§l§aVIP 3");
         $form->setContent("§l§a Bạn có chắc mua§6 ".$gr."§a với giá §6".$gia." Point".
		 "§b ⇨ §e Quyền Lợi VIP-3:".
  "§a » §b Fly [/fly]".
  "§a » §b Teleport [/tp]".
  "§a » §b Nick [/nick]".
"§a » §b In Đậm Chữ Chat".
 "§a » §b Time Set [/time]");
	   
        $form->setButton1("§l§6MUA", 1);
        $form->setButton2("§l§cTHOÁT", 2);
        $form->sendToPlayer($sender);
    }
    public function rank4($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
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
                        break;
                    case 2:
             //  $sender->sendMessage($this->getConfig()->get("rank4.cancelled"));
                        break;
            }
        });
		 $gia = 200;
      $gr = "VIP4";
      $day = 100;
              $form->setTitle("§l§aVIP 4");
          $form->setContent("§l§a Bạn có chắc mua§6 ".$gr."§a với giá §6".$gia." Point".
		"§b ⇨ §e Quyền Lợi VIP-4:".
 "§a » §b Fly [/fly]".
 "§a » §b Teleport [/tp]".
 "§a » §b Nick [/nick]".
"§a » §b In Đậm Chữ Chat".
 "§a » §b Time Set [/time]".
  "§a » §b hiệu ứng [/angel]");
	   
        $form->setButton1("§l§6MUA", 1);
        $form->setButton2("§l§cTHOÁT", 2);
        $form->sendToPlayer($sender);
    }
	
	    public function rank5($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
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
                        break;
                    case 2:
             //  $sender->sendMessage($this->getConfig()->get("rank5.cancelled"));
                        break;
            }
        });
		  $gia = 400;
      $gr = "VIP5";
        $form->setTitle("§l§aVIP 5");
         $form->setContent("§l§a Bạn có chắc mua§6 ".$gr."§a với giá §6".$gia." Point"
		 ."§b ⇨ §e Quyền Lợi VIP-5:".
 "§a » §b Fly [/fly]".
  "§a » §b Teleport [/tp]".
 "§a » §b Nick [/nick]".
"§a » §b In Đậm Chữ Chat".
"§a » §b Time Set [/time]".
"§a » §b Hiệu ứng [/angel]".
"§a » §b Đá người chơi [/kick]".
"§a » §b Weather [/weather]");
	   
        $form->setButton1("§l§6MUA", 1);
        $form->setButton2("§l§cTHOÁT", 2);
        $form->sendToPlayer($sender);
    }
	
	  /*  public function rank6($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $rank6 = $this->getCofig()->get("rank6.cost");
            if($money >= $rank6){
                
               $this->eco->reduceMoney($sender, $rank6);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . $this->getConfig()->get("rank6");
            return true;
               $sender->sendMessage($this->getConfig()->get("rank6.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("rank6.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("rank6.cancelled"));
                        break;
            }
        });
        $form->setTitle($this->getConfig()->get("rank6"));
        $form->setContent($this->getConfig()->get("rank6.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }
	
	    public function rank7($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $rank7 = $this->getConfig()->get("rank7.cost");
            if($money >= $rank7){
                
               $this->eco->reduceMoney($sender, $rank7);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . $this->getConfig()->get("rank7");
            return true;
               $sender->sendMessage($this->getConfig()->get("rank7.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("rank7.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("rank7.cancelled"));
                        break;
            }
        });
        $form->setTitle($this->getConfig()->get("rank7"));
        $form->setContent($this->getConfig()->get("rank7.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }
	
	    public function rank8($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $rank8 = $this->getConfig()->get("rank8.cost");
            if($money >= $rank8){
                
               $this->eco->reduceMoney($sender, $rank8);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . $this->getConfig()->get("rank8");
            return true;
               $sender->sendMessage($this->getConfig()->get("rank8.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("rank8.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("rank8.cancelled"));
                        break;
            }
        });
        $form->setTitle($this->getConfig()->("rank8"));
      //  $form->setContent($this->getConfig()->get("rank8.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }
	
	    public function rank9($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $rank9 = $this->getConfig()->get("rank9.cost");
            if($money >= $rank9){
                
               $this->eco->reduceMoney($sender, $rank9);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . $this->getConfig()->get("rank9");
            return true;
               $sender->sendMessage($this->getConfig()->get("rank9.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("rank9.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("rank9.cancelled"));
                        break;
            }
        });
        $form->setTitle($this->getConfig()->get("rank9"));
        $form->setContent($this->getConfig()->get("rank9.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }
	
	    public function rank10($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $rank10 = $this->getConfig()->get("rank10.cost");
            if($money >= $rank10){
                
               $this->eco->reduceMoney($sender, $rank9);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . $this->getConfig()->get("rank10");
            return true;
               $sender->sendMessage($this->getConfig()->get("rank10.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("rank10.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("rank10.cancelled"));
                        break;
            }
        });
        $form->setTitle($this->getConfig()->get("rank10"));
        $form->setContent($this->getConfig()->get("rank10.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }*/
 public function PermForm(Player $sender){
	 $player = $sender;
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
			
			
			$form->addButton("§l§d♥ §eVIP 1 §d♥",0,"http://img.zing.vn/volamthuphi/images/data/event2015/vip1.png");
			$form->addButton("§l§d♥ §eVIP 2 §d♥",1,"http://img.zing.vn/volamthuphi/images/data/event2015/vip2.png");
			$form->addButton("§l§d♥ §eVIP 3 §d♥",2,"http://img.zing.vn/volamthuphi/images/data/event2015/vip3.png");
			$form->addButton("§l§d♥ §eVIP 4 §d♥",3,"http://img.zing.vn/volamthuphi/images/data/event2015/vip4.png");
			$form->addButton("§l§d♥ §eVIP 5 §d♥",4,"http://img.zing.vn/volamthuphi/images/data/event2015/vip5.png");
			$form->sendToPlayer($player);
		}
    public function onDisable(){
        $this->getLogger()->info("§cDisabling RankShopUI plugin...");
    }
}