<?php

/**
 * RankSystem - ChatEventListener.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem\event;

use Fludixx\RankSystem\RankSystem;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class ChatEventListener implements Listener {

	public function onPlayerChatEvent(PlayerChatEvent $event) {
		$player = $event->getPlayer();
		if(isset(RankSystem::$players[$player->getName()])) {
			$format = is_null(RankSystem::$players[$player->getName()]->nick) ? RankSystem::$players[$player->getName()]->getRank()->getChatformat() :
				RankSystem::$ranks[RankSystem::getProvider()->getDefaultRank()->getName()]->getChatformat();
			$format = str_replace("%player%", RankSystem::$players[$player->getName()]->getNick(), $format);
			$format = str_replace("%msg%", $event->getMessage(), $format);
		} else {
			$format = "§7[???] {$player->getName()}: {$event->getMessage()}";
		}
		$event->setFormat($format);
	}

}