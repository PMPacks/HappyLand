<?php
namespace jasonwynn10\CrossOnlineCount;

use pocketmine\scheduler\Task;
use core\Main;
class UpdateTask extends Task {
	private $plugin;
	public function __construct(Main $plugin){
		$this->plugin = $plugin;
		
	}
	public function onRun($currentTick) {
		$this->plugin->update();
	}
}
