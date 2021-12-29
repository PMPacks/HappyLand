<?php

/**
 * RankSystem - QuitEventListener.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem\event;

use Fludixx\RankSystem\RankSystem;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;

class QuitEventListener implements Listener {

	public function onPlayerDeathEvent(PlayerDeathEvent $event) {
		$player = RankSystem::$players[$event->getPlayer()->getName()];
		if(!is_null($player->nick))
			RankSystem::getProvider()->saveNick($player);
	}

}