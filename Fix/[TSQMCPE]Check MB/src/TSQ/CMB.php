<?php

namespace TSQ;

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
use pocketmine\level\particle\LavaParticle;
use pocketmine\math\Vector3;
use pocketmine\entity\object\ItemEntity;
use pocketmine\scheduler\Task;
use pocketmine\utils\Config;
use pocketmine\Inventory;
use pocketmine\level\Level;
use pocketmine\entity\human;
use pocketmine\entity\Effect;
use pocketmine\level\sound\ExpPickupSound;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\network\protocol\SetTitlePacket;
use PTK\coinapi\Coin;

class CMB extends PluginBase implements Listener{
  public function onEnable(){
    }
    	 public function onCommand(CommandSender $s, Command $cmd, string $label, array $args) : bool{
    	 if($cmd->getName() == "clearlag"){
    	    $memory = memory_get_usage();
            $entityCount = 0;
            foreach ($this->getServer()->getLevels() as $level){
                $level->doChunkGarbageCollection();
                $level->unloadChunks(true);
                $level->clearCache(true);
                foreach($level->getEntities() as $entity){
                    if ($entity instanceof ItemEntity){
                        $entity->close();
                        ++$entityCount;
                    }
                }
            }
            $value = number_format(round((($memory - memory_get_usage()) / 1024) / 1024, 2));
            $this->getLogger()->info("\n\n\n[Đã dọn ".$value."MB Cache]\n\n\n");
            //$all = $this->getServer()->getOnlinePlayers();
            //$all->kick("Máy Chủ Đang Dọn Cache");
            }
           }
           }