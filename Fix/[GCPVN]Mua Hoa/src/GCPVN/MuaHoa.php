<?php

namespace GCPVN;

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
use pocketmine\math\Vector3;
use pocketmine\level\particle\{AngryVillagerParticle,BubbleParticle,CriticalParticle,DestroyBlockParticle,DustParticle,EnchantmentTableParticle,EnchantParticle,EntityFlameParticle,LargeExplodeParticle,FlameParticle,HappyVillagerParticle,HeartParticle,InkParticle,InstantEnchantParticle,ItemBreakParticle,LavaDripParticle,LavaParticle,MobSpellParticle,PortalParticle,RainSplashParticle,RedstoneParticle,SmokeParticle,SpellParticle,SplashParticle,SporeParticle,TerrainParticle,WaterDripParticle,WaterParticle,WhiteSmokeParticle};
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use onebone\economyapi\EconomyAPI;

class MuaHoa extends PluginBase implements Listener {
    
    public function onEnable() {
       $this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$this->hoa = $this->getServer()->getPluginManager()->getPlugin("HOA");
		$this->miluc = $this->getServer()->getPluginManager()->getPlugin("MILUC");
		$this->getLogger()->info("\n\n§l§a§oĐã Bật Hệ Thông Mua Hoa\n\n");
    }
	
    public function onDisable() {
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
    if($cmd->getName() == "muahoa"){
    if(empty($args[0])){
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§c /muahoa§a <Mã Gói>§f: Để mua Hoa theo các Gói. Các gói Hoa như sau:\n§f[♦§l§6Mua Hoa§r§f♦] §f•§c 1 Hoa:§a 800 Xu§f <Mã 1>\n§f[♦§l§6Mua Hoa§r§f♦] §f•§c 99 Hoa:§a 79.000 Xu§f <Mã 2>\n§f[♦§l§6Mua Hoa§r§f♦] §f•§c 199 Hoa:§a 159.200 Xu§f <Mã 3>\n§f[♦§l§6Mua Hoa§r§f♦] §f•§c 399 Hoa:§a 319.200 Xu§f <Mã 4>\n§f[♦§l§6Mua Hoa§r§f♦] §f•§c 520 Hoa:§a 416.000 Xu§f <Mã 5>");
    return true;
    }
    if($args[0] > 5 || $args[0] <= 0 || !is_numeric($args[0])){
	$sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦] §cMã gói không tồn tại");
    return true;
    }
    switch(strtolower($args[0])){
    case "1":
    if($this->money->reduceMoney($sender->getName(), 800)){
    $this->hoa->themHoa($sender->getName(), 1);
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Bạn đã mua thành công §c1 Hoa§a với giá §c800 Xu");
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Số Hoa hiện tại của bạn: §c".$this->hoa->xemHoa($sender->getName()));
    }else{
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§c Bạn không có đủ tiền để mua 1 Hoa");
    }
    break;
    return true;
    case "2":
    if($this->money->reduceMoney($sender->getName(), 79000)){
    $this->hoa->themHoa($sender->getName(), 99);
    $this->miluc->themMiLuc($sender->getName(), 9);
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Bạn đã mua thành công §c99 Hoa§a với giá §c79.000 Xu");
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Bạn được cộng thêm 9 điểm Mị Lực");
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Số Hoa hiện tại của bạn: §c".$this->hoa->xemHoa($sender->getName()));
    $sender->getServer()->broadcastPopup("§c ".$sender->getName()."§e đã mua§c 99 Hoa§e với giá§c 79.000 Đồng§e! §l§dVĩnh Kết Đồng Tâm\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
    }else{
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§c Bạn không có đủ tiền để mua 99 Hoa");
    }
    break;
    return true;
    case "3":
    if($this->money->reduceMoney($sender->getName(), 159200)){
    $this->hoa->themHoa($sender->getName(), 199);
    $this->miluc->themMiLuc($sender->getName(), 19);
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Bạn đã mua thành công §c199 Hoa§a với giá §c159.200 Xu");
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Bạn được cộng thêm 19 điểm Mị Lực");
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Số Hoa hiện tại của bạn: §c".$this->hoa->xemHoa($sender->getName()));
    $sender->getServer()->broadcastPopup("§c ".$sender->getName()."§e đã mua§c 199 Hoa§e với giá§c 159.200 Đồng§e! §l§bThề Non Hẹn Biển\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
    }else{
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§c Bạn không có đủ tiền để mua 199 Hoa");
    }
    break;
    return true;
    case "4":
    if($this->money->reduceMoney($sender->getName(), 319200)){
    $this->hoa->themHoa($sender->getName(), 399);
    $this->miluc->themMiLuc($sender->getName(), 29);
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Bạn đã mua thành công §c399 Hoa§a với giá §c319.200 Xu");
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Bạn được cộng thêm 29 điểm Mị Lực");
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Số Hoa hiện tại của bạn: §c".$this->hoa->xemHoa($sender->getName()));
    $sender->getServer()->broadcastPopup("§c ".$sender->getName()."§e đã mua§c 399 Hoa§e với giá§c 319.200 Đồng§e! §l§aNguyệt Thề Chung Lối\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
    }else{
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§c Bạn không có đủ tiền để mua 399 Hoa");
    }
    break;
    return true;
    case "5":
    if($this->money->reduceMoney($sender->getName(), 416000)){
    $this->hoa->themHoa($sender->getName(), 520);
    $this->miluc->themMiLuc($sender->getName(), 59);
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Bạn đã mua thành công §c520 Hoa§a với giá §c416.000 Xu");
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Bạn được cộng thêm 59 điểm Mị Lực");
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§a Số Hoa hiện tại của bạn: §c".$this->hoa->xemHoa($sender->getName()));
    $sender->getServer()->broadcastPopup("§c ".$sender->getName()."§e đã mua§c 520 Hoa§e với giá§c 416.000 Đồng§e! §l§6Bá Vũ Phu Thê\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
    }else{
    $sender->sendMessage("§f[♦§l§6Mua Hoa§r§f♦]§c Bạn không có đủ tiền để mua 520 Hoa");
    }
    break;
    return true;
   }
    return true;
  }
 }
}
/*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/