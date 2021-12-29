<?php

namespace xenialdan\BossAnnouncement;

use pocketmine\scheduler\Task;

class SendTask extends Task{
    public function __construct(Main $plugin){
        //parent::__construct($owner);
        $this->plugin = $plugin;
    }

    public function onRun(int $currentTick){	
        $this->plugin->sendBossBar();
    }

	public function cancel(){
		$this->getHandler()->cancel();
	}
}