<?php

namespace WingTest;

use pocketmine\plugin\PluginBase;
use pocketmine\level\Level;
use pocketmine\level\particle\FlameParticle;
use pocketmine\level\particle\DustParticle;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;

class Loader extends PluginBase implements Listener {
    
    public $list;
    
    public function onEnable() {
        
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->list = array();
        $this->getScheduler()->scheduleRepeatingTask(new HocTask($this), 5);
        
    }
    
    public function onParticles(Player $p) {
        
        if(isset($this->list[strtolower($p->getName())])) {
            
                $pos = $p->getPosition();
				
                $red = new FlameParticle($pos->add(0, 0.5));
				$red1 = new FlameParticle($pos->add(-0.1, 0.4));
				$red2 = new FlameParticle($pos->add(-0.2, 0.4));
				$red3 = new FlameParticle($pos->add(-0.3, 0.4));
				$red4 = new FlameParticle($pos->add(-0.4, 0.4));
				$red5 = new FlameParticle($pos->add(-0.5, 0.4)); 
				$red6 = new FlameParticle($pos->add(0.1, 0.4));
				$red7 = new FlameParticle($pos->add(0.2, 0.4));
				$red8 = new FlameParticle($pos->add(0.3, 0.4));
				$red9 = new FlameParticle($pos->add(0.4, 0.4));
				$red10 = new FlameParticle($pos->add(0.5, 0.4));
				$blue = new FlameParticle($pos->add(0.6, 0.5));
				$blue1 = new FlameParticle($pos->add(0.6, 0.6));
				$blue2 = new FlameParticle($pos->add(-0.6, 0.5));
				$blue3 = new FlameParticle($pos->add(-0.6, 0.6));
				$blue4 = new FlameParticle($pos->add(-0.6, 0.7));
				$blue5 = new FlameParticle($pos->add(0.6, 0.7));
				$blue6 = new FlameParticle($pos->add(0.5, 0.7));
				$blue7 = new FlameParticle($pos->add(-0.5, 0.7));
				$blue8 = new FlameParticle($pos->add(0.5, 0.8));
				$blue9 = new FlameParticle($pos->add(-0.5, 0.8));
				$blue10 = new FlameParticle($pos->add(0.4, 0.8));
				$blue11 = new FlameParticle($pos->add(0.3, 0.8));
				$blue12 = new FlameParticle($pos->add(0.2, 0.8));
				$blue13 = new FlameParticle($pos->add(-0.3, 0.8));
				$blue14 = new FlameParticle($pos->add(-0.2, 0.8));
				$yellow = new FlameParticle($pos->add(0.2, 0.9));
				$yellow1 = new FlameParticle($pos->add(0.2, 1));
				$yellow2 = new FlameParticle($pos->add(0.2, 1.1));
				$yellow3 = new FlameParticle($pos->add(0.2, 1.2));
				$yellow4 = new FlameParticle($pos->add(0.2, 1.3));
				$yellow5 = new FlameParticle($pos->add(-0.2, 0.9));
				$yellow6 = new FlameParticle($pos->add(-0.2, 1));
				$yellow7 = new FlameParticle($pos->add(-0.2, 1.1));
				$yellow8 = new FlameParticle($pos->add(-0.2, 1.2));
				$yellow9 = new FlameParticle($pos->add(-0.2, 1.3));
				$pink = new FlameParticle($pos->add(0.2, 1.4));
				$pink1 = new FlameParticle($pos->add(0.1, 1.4));
				$pink2 = new FlameParticle($pos->add(0, 1.3));
				$pink3 = new FlameParticle($pos->add(-0.2, 1.4));
				$pink4 = new FlameParticle($pos->add(-0.1, 1.4));
				
                $level = $p->getLevel();
                
                foreach([$red, $red1, $red2, $red3, $red4, $red5, $red6, $red7, $red8, $red9, $red10, $blue, $blue1, $blue2, $blue3, $blue4, $blue5, $blue6, $blue7, $blue8, $blue9, $blue10, $blue11, $blue12, $blue13, $blue14, $yellow, $yellow1, $yellow2, $yellow3, $yellow4, $yellow5, $yellow6, $yellow7, $yellow8, $yellow9, $pink, $pink1, $pink2, $pink3,$pink4] as $particle) {
                    
                    $level->addParticle($particle);
                    
                }
                
        }
        
    }
    
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        
        switch(strtolower($command->getName())) {
            
            case "wingtest":
                
            if($sender->hasPermission("wingtest.command")) {
                    
                if(isset($this->list[strtolower($sender->getName())])) {
                                   
                unset($this->list[strtolower($sender->getName())]);
                $sender->sendMessage("§cTắt");
                                     
				}else {
                                    
                $this->list[strtolower($sender->getName())] = strtolower($sender->getName());
                $sender->sendMessage("§aBật");
				}
			}
		}      
    return true;
	}
 
    public function onDisable() {
    }
}
#plugin by Khang Đẹp Trai