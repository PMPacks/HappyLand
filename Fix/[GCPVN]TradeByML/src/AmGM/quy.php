<?php

namespace AmGM;

use pocketmine\item\ItemIds;
use pocketmine\inventory\ShapedRecipe;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\entity\Effect;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\math\Vector3;
use pocketmine\level\particle\{AngryVillagerParticle,BubbleParticle,CriticalParticle,DestroyBlockParticle,DustParticle,EnchantmentTableParticle,EnchantParticle,EntityFlameParticle,LargeExplodeParticle,FlameParticle,HappyVillagerParticle,HeartParticle,InkParticle,InstantEnchantParticle,ItemBreakParticle,LavaDripParticle,LavaParticle,MobSpellParticle,PortalParticle,RainSplashParticle,RedstoneParticle,SmokeParticle,SpellParticle,SplashParticle,SporeParticle,TerrainParticle,WaterDripParticle,WaterParticle,WhiteSmokeParticle};
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

class quy extends PluginBase implements Listener {
	
	
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->miluc = $this->getServer()->getPluginManager()->getPlugin("MILUC");
		$this->getLogger()->info("\n\n§l§d§oĐã Bật Hệ Thống Đổi Đồ Bằng Điểm Mị Lực\n\n");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
     if($cmd->getName() == "doicup"){
     if(empty($args[0])){
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§c /doicup§a <Mã Vật Phẩm>§f: Để đổi cúp bằng điểm Mị Lực, các mã vật phẩm gồm:\n§f[♦§l§6Đổi Đồ§r§f♦] §f•§c Cúp Final:§a 80 điểm Mị Lực§f <Mã 1>\n§f[♦§l§6Đổi Đồ§r§f♦] §f•§c Cúp Ocean:§a 190 điểm Mị Lực§f <Mã 2>\n§f[♦§l§6Đổi Đồ§r§f♦] §f•§c Cúp Jungle:§a 300 điểm Mị Lực§f <Mã 3>\n§f[♦§l§6Đổi Đồ§r§f♦] §f•§c Cúp Mountain:§a 419 điểm Mị Lực§f <Mã 4>\n§f[♦§l§6Đổi Đồ§r§f♦] §f•§c Cúp Hamster:§a 700 điểm Mị Lực§f <Mã 5>\n§f[♦§l§6Đổi Đồ§r§f♦] §f•§c Cúp Roblin:§a 890 điểm Mị Lực§f <Mã 6>");
     return true;
     }
     if($args[0] > 6 || $args[0] <= 0 || !is_numeric($args[0])){
		$sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦] §cMã vật phẩm không tồn tại");
     return true;
     }
     switch(strtolower($args[0])){
     case "1":
     if($this->miluc->xemMiLuc($sender->getName()) >= 80){
     $this->miluc->truMiLuc($sender->getName(), 80);
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§a Bạn đã đổi thành công §cCúp Final§a bằng §c80 điểm Mị Lực");
     $final = Item::get(257, 0, 1);
	 $ecfinal1 = Enchantment::getEnchantment(15);
	 $fi1 = new EnchantmentInstance($ecfinal1,25);
     $ecfinal2 = Enchantment::getEnchantment(17);
     $fi2 = new EnchantmentInstance($ecfinal2,5);
     $final->addEnchantment($fi1);
     $final->addEnchantment($fi2);
	 $final->setCustomName("§l§aC§eú§cp§4 Final\n");
	 $sender->getInventory()->addItem($final);
     }else{
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§c Bạn không có 80 điểm Mị Lực để đổi Cúp Final");
     }
     break;
     return true;
     case "2":
    if($this->miluc->xemMiLuc($sender->getName()) >= 190){
     $this->miluc->truMiLuc($sender->getName(), 190);
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§a Bạn đã đổi thành công §cCúp Ocean§a bằng §c190 điểm Mị Lực");
     $ocean = Item::get(257, 0, 1);
	 $ecocean1 = Enchantment::getEnchantment(15);
	 $oc1 = new EnchantmentInstance($ecocean1,25);
     $ecocean2 = Enchantment::getEnchantment(17);
     $oc2 = new EnchantmentInstance($ecocean2,8);
     $ecocean3 = Enchantment::getEnchantment(16);
     $oc3 = new EnchantmentInstance($ecocean3,2);
     $ecocean4 = Enchantment::getEnchantment(18);
     $oc4 = new EnchantmentInstance($ecocean4,1);
     $ocean->addEnchantment($oc1);
     $ocean->addEnchantment($oc2);
     $ocean->addEnchantment($oc3);
     $ocean->addEnchantment($oc4);
	 $ocean->setCustomName("§l§bC§6ú§ep§b Ocean\n");
	 $sender->getInventory()->addItem($ocean);
     }else{
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§c Bạn không có 80 điểm Mị Lực để đổi Cúp Ocean");
     }
     break;
     return true;
     case "3":
     if($this->miluc->xemMiLuc($sender->getName()) >= 300){
     $this->miluc->truMiLuc($sender->getName(), 300);
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§a Bạn đã đổi thành công §cCúp Jungle§a bằng §c300 điểm Mị Lực");
     $jungle = Item::get(285, 0, 1);
	 $ecjungle1 = Enchantment::getEnchantment(15);
	 $jg1 = new EnchantmentInstance($ecjungle1,30);
     $ecjungle2 = Enchantment::getEnchantment(17);
     $jg2 = new EnchantmentInstance($ecjungle2,10);
     $jungle->addEnchantment($jg1);
     $jungle->addEnchantment($jg2);
	 $jungle->setCustomName("§l§aC§3ú§fp§6 Jungle\n");
	 $sender->getInventory()->addItem($jungle);
     }else{
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§c Bạn không có 300 điểm Mị Lực để đổi Cúp Jungle");
     }
     break;
     return true;
     case "4":
 if($this->miluc->xemMiLuc($sender->getName()) >= 419){
     $this->miluc->truMiLuc($sender->getName(), 419);
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§a Bạn đã đổi thành công §cCúp Mountain§a bằng §c419 điểm Mị Lực");
     $mt = Item::get(285, 0, 1);
	 $ecmt1 = Enchantment::getEnchantment(15);
	 $mt1 = new EnchantmentInstance($ecmt1,50);
     $mt->addEnchantment($mt1);
	 $mt->setCustomName("§l§aC§3ú§fp§6 Mountain\n");
	 $sender->getInventory()->addItem($mt);
     }else{
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§c Bạn không có 419 điểm Mị Lực để đổi Cúp Mountain");
     }
     break;
     return true;
     case "5":
 if($this->miluc->xemMiLuc($sender->getName()) >= 700){
     $this->miluc->truMiLuc($sender->getName(), 700);
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§a Bạn đã đổi thành công §cCúp Hamster§a bằng §c700 điểm Mị Lực");
     $hs = Item::get(278, 0, 1);
	 $echs1 = Enchantment::getEnchantment(15);
	 $hs1 = new EnchantmentInstance($echs1,50);
     //$ecfinal = Enchantment::getEnchantment(17)->setLevel(5);
     $hs->addEnchantment($hs1);
	 $hs->setCustomName("§l§e✴§6 CÚP HAMSTER§e ✴\n");
	 $sender->getInventory()->addItem($hs);
     }else{
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§c Bạn không có 700 điểm Mị Lực để đổi Cúp Hamster");
     }
     break;
     return true;
     case "6":
     if($this->miluc->xemMiLuc($sender->getName()) >= 890){
     $this->miluc->truMiLuc($sender->getName(), 890);
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§a Bạn đã đổi thành công §cCúp Roblin§a bằng §c890 điểm Mị Lực");
     $rb = Item::get(278, 0, 1);
	 $ecrb1 = Enchantment::getEnchantment(15);
	 $rb1 = new EnchantmentInstance($ecrb1,100);
     $ecrb2 = Enchantment::getEnchantment(17);
     $rb2 = new EnchantmentInstance($ecrb2,100);
     $rb->addEnchantment($rb1);
     $rb->addEnchantment($rb2);
	 $rb->setCustomName("§l§c✴§b CÚP ROBLIN§c ✴\n");
	 $sender->getInventory()->addItem($rb);
     }else{
     $sender->sendMessage("§f[♦§l§6Đổi Đồ§r§f♦]§c Bạn không có 890 điểm Mị Lực để đổi Cúp Roblin");
     }
     break;
     return true;
   }
     return true;
  }
 }
}