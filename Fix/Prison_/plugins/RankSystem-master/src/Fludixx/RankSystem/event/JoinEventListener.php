<?php

/**
 * RankSystem - JoinEventListener.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem\event;

use Fludixx\RankSystem\provider\InvalidConfigurationException;
use Fludixx\RankSystem\RankSystem;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class JoinEventListener implements Listener {

	public function onPlayerJoinEvent(PlayerJoinEvent $event) {
		$player = $event->getPlayer();
		try {
			RankSystem::getProvider()->isPlayerRegistered($player);
		} catch (InvalidConfigurationException $exception) {
			RankSystem::getInstance()->getLogger()->error("You have Invalid Configuration Files.");
			RankSystem::getInstance()->getLogger()->error($exception->getMessage());
			$player->kick($exception->getMessage());
		}
		RankSystem::getProvider()->loginPlayer($player->getName());
	}

}