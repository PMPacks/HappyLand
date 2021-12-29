<?php

/**
 * RankSystem - rsCommand.php
 * @author Fludixx
 */

declare(strict_types=1);

namespace Fludixx\RankSystem\command;

use Fludixx\RankSystem\provider\MySqlProvider;
use Fludixx\RankSystem\provider\YamlProvider;
use Fludixx\RankSystem\RankSystem;
use Fludixx\RankSystem\utils\Utils;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class rsCommand extends Command {

	public function __construct()
	{
		parent::__construct("rs",
			"RankSystem",
			RankSystem::PREFIX."/rs reload/transfare/list",
			[]);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args)
	{
		if($sender->hasPermission("rs.manage") && isset($args[0])) {
			switch ($args[0]) {
				case 'reload':
					$sender->sendMessage(RankSystem::PREFIX."Lade Ränge neu...");
					RankSystem::loadRanks();
					break;
				case 'list':
					$str = "";
					foreach(RankSystem::$ranks as $name => $data) {
						$str .= "{$data->getName()} ";
					}
					$sender->sendMessage($str);
					break;
				case 'transfare':
					if(RankSystem::getProvider() instanceof MySqlProvider) {
						$sender->sendMessage(RankSystem::PREFIX."Transfering YAML to MySQL...");
						$sender->sendMessage(RankSystem::PREFIX."Bitte warten sie das könnte einen Moment daueren...");
						$conn = new \mysqli(RankSystem::getSettings()['mysql']['host'], RankSystem::getSettings()['mysql']['user'],
							RankSystem::getSettings()['mysql']['pass'], RankSystem::getSettings()['mysql']['db']);
						$yaml = new YamlProvider(RankSystem::getSettings()['config_storage']);
						foreach ($yaml->getAllRanks() as $name => $rank) {
							$perms = Utils::permArrayToString($rank['permissions']);
							$isDefault = $rank['default'] ? 1 : 0;
							$conn->query("INSERT IGNORE INTO ranks(rankName, rankPerms, rankNametag, rankChatformat, isDefault)
								VALUES('{$name}', '{$perms}', '{$rank["nametag"]}', '{$rank["chatformat"]}', {$isDefault})");
							$sender->sendMessage(RankSystem::PREFIX."Rank '{$name}' wurde exportiert!");
						}
						$sender->sendMessage(RankSystem::PREFIX."Alle ränge wurden exportiert!");
						return TRUE;
					} else {
						$sender->sendMessage(RankSystem::PREFIX."Zurzeit kannst du nur YAML zu MySql Transferieren");
						return FALSE;
					}
			}
		} else {
			$sender->sendMessage($this->usageMessage);
		}
		return FALSE;
	}

}