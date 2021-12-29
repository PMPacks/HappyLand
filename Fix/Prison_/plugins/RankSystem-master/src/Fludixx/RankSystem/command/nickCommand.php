<?php

/**
 * RankSystem - nickCommand.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem\command;

use Fludixx\RankSystem\RankSystem;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class nickCommand extends Command {

	public function __construct()
	{
		parent::__construct("nick",
			"Nick Command",
			RankSystem::PREFIX."/rs",
			[]);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args)
	{
		$nicks = RankSystem::$nicks;
		shuffle($nicks);
		if($sender->hasPermission("rs.nick")) {
			$player = RankSystem::$players[$sender->getName()];
			if(is_null($player->nick)) {
				$player->setNick($nicks[0]);
				$sender->sendMessage(RankSystem::PREFIX."You are now nicked as: {$nicks[0]}!");
			} else {
				$player->setNick(NULL);
				$sender->sendMessage(RankSystem::PREFIX."Your nick was removed!");
			}
		}
	}

}