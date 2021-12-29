<?php

namespace TSQ;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;

class th extends PluginBase{

		public function onEnable (){
		$this->dong = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$this->hoa = $this->getServer()->getPluginManager()->getPlugin("HOA");
		$this->miluc = $this->getServer()->getPluginManager()->getPlugin("MILUC");
		}
		public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		if ($cmd == "tanghoa"){
		if(empty($args[0] || $args[1])){
		$sender->sendMessage("§f[♦§l§6Tặng Hoa§r§f♦]§c /tanghoa§a <Tên Người Chơi> <Số Hoa>§f: Tặng số Hoa mình đang có cho người khác\n§f[♦§l§6Tặng Hoa§r§f♦]§f •§c 1 Hoa§f tăng§c 2 điểm Mị Lực§f cho cả 2 bên");
		return true;
		}
		$myhoa = $this->hoa->xemHoa($sender->getName());
		if($args[1] <= 0 || $args[1] > $myhoa){
		$sender->sendMessage("§f[♦§l§6Tặng Hoa§r§f♦]§c Số Hoa không hợp lệ");
		return true;
		}
		if(!is_numeric($args[1])){
		$sender->sendMessage("§f[♦§l§6Tặng Hoa§r§f♦]§c Hoa phải là số");
		return true;
		}
		$player = $this->getServer()->getPlayer($args[0]);
		if(!($player == null)){
		if($player->isOnline()){
		$tang = $args[1] * 2;
		$this->miluc->themMiLuc($sender->getName(), $args[1] * 2);
		$this->miluc->themMiLuc($args[0], $args[1] * 2);
		$this->hoa->truHoa($sender->getName(), $args[1]);
		$this->hoa->themHoa($args[0], $args[1]);
		$sender->sendMessage("§f[♦§l§6Tặng Hoa§r§f♦]§a Tặng §c".$args[1]."§a Hoa cho§c ".$args[0]."§a thành công, tăng§c ".$tang."§a điểm Mị Lực");
		$this->getServer()->broadcastTitle("§l§c♥", "§c".$sender->getName()."§a tặng§c ".$args[0]."§a ".$args[1]." Hoa");
		}else{
			$sender->sendMessage("§f[♦§l§6Tặng Hoa§r§f♦]§c Người chơi không trực tuyến");
		return true;
		}
		
			}
		}
		return true;
	}
}
/*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/ /*DJTME CON NGUOI CAU TOAN*/