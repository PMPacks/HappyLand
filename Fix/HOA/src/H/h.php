<?php

namespace H;

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
//use PTK\coinapi\Coin;

class h extends PluginBase implements Listener{
    
    public $data;
    //public $level;
    private $config, $amount;
    
    public function onEnable(){
       if(!file_exists($this->getDataFolder() . "HOA/")){
       @mkdir($this->getDataFolder() . "HOA/");
       }
        
       $this->hoa = new Config($this->getDataFolder() . "HOA/" . "HOA.yml", Config::YAML);
       $this->saveDefaultConfig();
       $this->config = $this->getConfig();
       $this->config->save();
       $this->getServer()->getPluginManager()->registerEvents($this,$this);
       $this->getLogger()->info("\n\n§l§cT í n h  n ă n g  H o a  đ ã  b ậ t  \n\n");
        }
    
    public function onJoin(PlayerJoinEvent $ev){
        $player = $ev->getPlayer()->getName();
        if(!($this->hoa->exists(strtolower($player)))){
            $this->hoa->set(strtolower($player), "0");
            $this->hoa->save();
            return true;
             }
            }
             public function xemHoa($player){
          if($player instanceof Player){
          $player = $player->getName();
          }
          $player = strtolower($player);
         $addh = $this->hoa->get($player);
         return $addh;
         }
         public function themHoa($player, $amount){
         $amount = round($amount, 2);
         if($amount <= 0 or !is_numeric($amount)){
        
         if($player instanceof Player){
         $player = $player->getName();
         }
        }
         $player = strtolower($player);
        $c[0] = $this->hoa->get($player) + $amount;
        $this->hoa->set(strtolower($player), "".$c[0]."");
        $this->hoa->save();
        
         }
         public function truHoa($player, $amount){
         $amount = round($amount, 2);
         if($amount <= 0 or !is_numeric($amount)){
        
         if($player instanceof Player){
         $player = $player->getName();
         }
        }
        $player = strtolower($player);
        $c[0] = $this->hoa->get($player) - $amount;
        $this->hoa->set(strtolower($player), "".$c[0]."");
        $this->hoa->save();
        
        }
        public function onCommand(CommandSender $s, Command $cmd, string $label, array $args): bool{
        switch($cmd->getName()){
		case "hoa":
		if($s->isOp()){
        $s->sendMessage("§f[♦§l§6Hoa§r§f♦] §c/truhoa §a<Tên Nick> <Số Hoa>§f: Trừ Hoa của một Player");
        $s->sendMessage("§f[♦§l§6Hoa§r§f♦] §c/themhoa §a<Tên Nick> <Số Hoa>§f: Thêm Hoa cho một Player");
        }else{
        $s->sendMessage("§f[♦§l§6Hoa§r§f♦] §c/sohoa§f: Xem số Hoa bạn đang sở hữu");
        }
        break;
        return true;
        case "sohoa":
        $s->sendMessage("§f[♦§l§6Hoa§r§f♦]§c Số Hoa bạn đang sở hữu:§a ".$this->xemHoa($s->getName()));
        break;
        return true;
        case "truhoa":
        if($s->isOp()){ //1
        $this->hoa->truHoa($args[0], $args[1]);
        $s->sendMessage("Tru hoa thanh cong");
        }else{ //1
        $s->sendMessage("Ban khong co quyen su dung lenh nay");
        break;
        return true;
        }
		case "themhoa":
        if($s->isOp()){ //1
        $this->hoa->themHoa($args[0], $args[1]);
        $s->sendMessage("Them hoa thanh cong");
        }else{ //1
        $s->sendMessage("Ban khong co quyen su dung lenh nay");
        break;
        return true;
					}
					case "tophoa":
                $max = 0;
				$max += count($this->hoa->getAll());
				$max = ceil(($max / 5));
				$page = array_shift($args);
				$page = max(1, $page);
				$page = min($max, $page);
				$page = (int)$page;
				$s->sendMessage("§c§l♦§a --------§e Đua Top Đào Hoa (§c".$page."/".$max."§e)§a --------§c♦");
				$aa = $this->hoa->getAll();
				arsort($aa);
				$i = 0;
				foreach($aa as $b=>$a){
				if(($page - 1) * 5 <= $i && $i <= ($page - 1) * 5 + 4){
				$i1 = $i + 1;
				$a = (int)$a;
				$s->sendMessage("§c♦§e Hạng §a".$i1."§e là§d ".$b."§e với§c ".$a." Hoa");
				}
				$i++;
				}
			break;
					}
					return true;
					}
				}
/*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/