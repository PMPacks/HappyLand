<?php

/**
 * RankSystem - setrankCommand.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem\command;

use Fludixx\RankSystem\RankSystem;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class setrankCommand extends Command {

	public function __construct()
	{
		parent::__construct("setrank",
			"/setrank <name> <rank> - Change the Rank of an Player",
			RankSystem::PREFIX."/setrank <name> <rank>",
			["setgroup"]);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args)
	{
		if($sender->hasPermission("rs.manage")) {
			if(count($args) < 1) {
				$sender->sendMessage($this->usageMessage);
				return FALSE;
			} else {
				$target = RankSystem::getInstance()->getServer()->getPlayer($args[0]);
				if(isset(RankSystem::$ranks[$args[1]])) {
					$rank = RankSystem::$ranks[$args[1]];
				} else {
					$sender->sendMessage(RankSystem::PREFIX."Der Rang {$args[1]} wurde nicht gefunden!");
					return FALSE;
				}
				if($target instanceof Player) {
					RankSystem::getProvider()->setRankOfPlayer(RankSystem::$players[$target->getName()], $rank);
					$sender->sendMessage(RankSystem::PREFIX."Der Spieler {$target->getName()} hat nun den Rang: {$rank->getName()}");
					return TRUE;
				} else if (isset(RankSystem::$players[$args[0]])) {
					RankSystem::getProvider()->setRankOfPlayer(RankSystem::$players[$args[0]], $rank);
					$sender->sendMessage(RankSystem::PREFIX."Der Spieler {$args[0]} hat nun den Rang: {$rank->getName()}");
					return TRUE;
				} else {
					$sender->sendMessage(RankSystem::PREFIX."Player wasen't found!");
					return FALSE;
				}
			}
		}
		return FALSE;
	}

}