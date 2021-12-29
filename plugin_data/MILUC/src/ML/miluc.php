<?php

namespace ML;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\event\player\{PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\level\particle\{AngryVillagerParticle,BubbleParticle,CriticalParticle,DestroyBlockParticle,DustParticle,EnchantmentTableParticle,EnchantParticle,EntityFlameParticle,LargeExplodeParticle,FlameParticle,HappyVillagerParticle,HeartParticle,InkParticle,InstantEnchantParticle,ItemBreakParticle,LavaDripParticle,LavaParticle,MobSpellParticle,PortalParticle,RainSplashParticle,RedstoneParticle,SmokeParticle,SpellParticle,SplashParticle,SporeParticle,TerrainParticle,WaterDripParticle,WaterParticle,WhiteSmokeParticle};
use pocketmine\math\Vector3;
use pocketmine\utils\Config;
use pocketmine\Inventory;
use pocketmine\level\Level;
use pocketmine\entity\human;
use pocketmine\entity\Effect;
use pocketmine\network\protocol\SetTitlePacket;
use PTK\coinapi\Coin;

class miluc extends PluginBase implements Listener{
    
    public $data;
    public $level;
    private $config, $amount;
    
    public function onEnable(){
       if(!file_exists($this->getDataFolder() . "MiLuc/")){
            @mkdir($this->getDataFolder() . "MiLuc/");
        }
        
        $this->miluc = new Config($this->getDataFolder() . "MiLuc/" . "miluc.yml", Config::YAML);
        $this->saveDefaultConfig();
        $this->config = $this->getConfig();
        $this->config->save();
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info("§l§dT í n h  n ă n g  M ị  L ự c  đ ã   b ậ t  ");
    }
    
    public function onJoin(PlayerJoinEvent $ev){
        $player = $ev->getPlayer()->getName();
        if(!($this->miluc->exists(strtolower($player)))){
            $this->miluc->set(strtolower($player), "0");
            $this->miluc->save();
            return true;
        }
    }
             public function xemMiLuc($player){
          if($player instanceof Player){
          $player = $player->getName();
          }
          $player = strtolower($player);
         $addml = $this->miluc->get($player);
         return $addml;
         }
         public function themMiLuc($player, $amount){
         $amount = round($amount, 2);
         if($amount <= 0 or !is_numeric($amount)){
        
         if($player instanceof Player){
         $player = $player->getName();
         }
       }
         $player = strtolower($player);
        $c[0] = $this->miluc->get($player) + $amount;
        $this->miluc->set(strtolower($player), "".$c[0]."");
        $this->miluc->save();
        
         }
         public function truMiLuc($player, $amount){
         $amount = round($amount, 2);
         if($amount <= 0 or !is_numeric($amount)){
        
         if($player instanceof Player){
         $player = $player->getName();
         }
       }
         $player = strtolower($player);
        $c[0] = $this->miluc->get($player) - $amount;
        $this->miluc->set(strtolower($player), "".$c[0]."");
        $this->miluc->save();
        
         }
        public function onCommand(CommandSender $s, Command $cmd, string $label, array $args): bool{
        switch($cmd->getName()){
		case "miluc":
		if($s->isOp()){
        $s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §c/diemmiluc§f: Xem số điểm Mị Lực bạn đang sở hữu");
        $s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §c/trumiluc §a<Tên Nick> <Số Hoa>§f: Trừ điểm Mị Lực của một Player");
        $s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §c/themmiluc §a<Tên Nick> <Số Hoa>§f: Thêm điểm Mị Lực cho một Player");
        }else{
        $s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §c/diemmiluc§f: Xem số điểm Mị Lực bạn đang sở hữu");
        break;
        return true;
        }
        case "diemmiluc":
        if($s instanceof Player) {	
        $s->sendMessage("§f[♦§l§6Mị Lực§r§f♦]§c Số điểm Mị Lực bạn đang sở hữu:§a ".$this->xemMiLuc($s->getName()));
        }
        break;
        return true;
        case "trumiluc":
		if(!$s instanceof Player){
		$s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §cLỗi: §cHãy sử dụng câu lệnh trong Game");
        if(!is_numeric($args[1])){
		$s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §cLỗi: §a".$args[1]."§c không phải là số");
		if(!isset($arg[0])){ 
        $s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §cLỗi: §cBạn chưa nhập tên Player muốn trừ điểm Mị Lực");
        return false;
        }
		if(!isset($arg[1])){ 
        $s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §cLỗi: §cBạn chưa nhập số điểm Mị Lực muốn trừ");
        return false;
        }
		$player = $this->getServer()->getPlayer($args[0]);
		if(!$this->miluc->exists(strtolower($player))){
		$s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §cLỗi: §cNgười chơi không trực tuyến");
		return true;
		}
		}
		}
		if($s->isOp()){
		$this->truMiLuc($args[0], $args[1]);
		$s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §aBạn đã trừ ".$args[1]." điểm Mị Lực của ".$args[0]);
		}else{
		$s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §cLỗi: Bạn không có quyền để thực hiện câu lệnh");
		}
		break;
		return true;
		case "themmiluc":
		if(!$s instanceof Player) {
		$s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §cLỗi: §cHãy sử dụng câu lệnh trong Game");
        if(!is_numeric($args[1])){
		$s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §cLỗi: §a".$args[1]."§c không phải là số");
		if(!isset($arg[0])){ 
        $s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §cLỗi: §cBạn chưa nhập tên Player muốn thêm điểm Mị Lực");
        return false;
        }
		if(!isset($arg[1])){ 
        $s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §cLỗi: §cBạn chưa nhập số điểm Mị Lực muốn thêm");
        return false;
        }
		$player = $this->getServer()->getPlayer($args[0]);
		if(!$this->miluc->exists(strtolower($player))){
		$s->sendMessage("§f[♦§l§6Mị Lực§r§f♦] §cLỗi: §cNgười chơi không trực tuyến");
		return true;
		}
		}
		}
		if($s->isOp()){
		$this->themMiLuc($args[0], $args[1]);
		$s->sendMessage("§f[♦§l§6Mị Lực§r§f♦]§aBạn đã thêm ".$args[1]." điểm Mị Lực cho ".$args[0]);
		}else{
		$s->sendMessage("§f[♦§l§6Mị Lực§r§f♦]§cLỗi: Bạn không có quyền để thực hiện câu lệnh");
		return true;
		       }
		        case "topmiluc":
                $max = 0;
				$max += count($this->miluc->getAll());
				$max = ceil(($max / 5));
				$page = array_shift($args);
				$page = max(1, $page);
				$page = min($max, $page);
				$page = (int)$page;
				$s->sendMessage("§c§l♦§a --------§e Đua Top Mê Hoặc (§c".$page."/".$max."§e)§a --------§c♦");
				$aa = $this->miluc->getAll();
				arsort($aa);
				$i = 0;
				foreach($aa as $b=>$a){
				if(($page - 1) * 5 <= $i && $i <= ($page - 1) * 5 + 4){
				$i1 = $i + 1;
				$a = (int)$a;
				$s->sendMessage("§c♦§e Hạng §a".$i1."§e là§d ".$b."§e với§c ".$a." điểm Mị Lực");
				}
				$i++;
				}
			break;
					}
					return true;
					}
				}
/*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/