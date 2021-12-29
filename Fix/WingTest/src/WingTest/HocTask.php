<?php

namespace WingTest;

use pocketmine\scheduler\Task;
use pocketmine\Player;
use pocketmine\Server;

class HocTask extends Task {
    
    public $plugin;
    
    public function __construct(Loader $plugin) {
        $this->plugin = $plugin;
    }
    
    public function onRun($currentTick) {
        
        foreach($this->plugin->getServer()->getOnlinePlayers() as $p) {
            
            $this->plugin->onParticles($p);
            
        }
        
    }
       
}