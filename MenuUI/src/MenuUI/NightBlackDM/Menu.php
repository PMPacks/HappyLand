<?php

declare(strict_types=1);

namespace MenuUI\NightBlackDM;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\Player;
use jojoe77777\FormAPI;

class Menu extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getLogger()->info("§l§aEnable");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onDisable(){
		$this->getLogger()->info("§l§cDisable");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool {
		switch($cmd->getName()){
			case "menuwarp":
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(function (Player $sender, $data){
				$result = $data;
				if ($result == null) {
				}
				switch ($result) {
					case 0:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp a");
					break;
					case 1:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp b");
					break;
					case 2:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp c");
					break;
					case 3:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp d");
					break;
					case 4:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp e");
					break;
					case 5:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp f");
					break;
					case 6:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp g");
					break;
					case 7:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp h");
					break;
					case 8:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp i");
					break;
					case 9:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp j");
					break;
					case 10:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp k");
					break;
					case 11:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp l");
					break;
					case 12:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp m");
					break;
					case 13:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp n");
					break;
					case 14:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp o");
					break;
					case 16:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp p");
					break;
					case 17:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp q");
					break;
					case 18:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp r");
					break;
					case 19:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp s");
					break;
					case 20:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp t");
					break;
					case 21:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp u");
					break;
					case 22:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp v");
					break;
					case 23:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp w");
					break;
					case 24:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp x");
					break;
					case 25:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp y");
					break;
					case 26:
					$this->getServer()->getCommandMap()->dispatch($sender, "warp z");
					break;
				}
			});
			$form->setTitle("§l§a•§e[§bMenu§e]§a•");
			$form->setContent("§l§b Menu Warp");
			$form->addButton("§l§c•§f Warp §eA §c•");
			$form->addButton("§l§c•§f Warp §eB §c•");
			$form->addButton("§l§c•§f Warp §eC §c•");
			$form->addButton("§l§c•§f Warp §eD §c•");
			$form->addButton("§l§c•§f Warp §eE §c•");
			$form->addButton("§l§c•§f Warp §eF §c•");
			$form->addButton("§l§c•§f Warp §eG §c•");
			$form->addButton("§l§c•§f Warp §eH §c•");
			$form->addButton("§l§c•§f Warp §eI §c•");
			$form->addButton("§l§c•§f Warp §eJ §c•");
			$form->addButton("§l§c•§f Warp §eK §c•");
			$form->addButton("§l§c•§f Warp §eL §c•");
			$form->addButton("§l§c•§f Warp §eM §c•");
			$form->addButton("§l§c•§f Warp §eN §c•");
			$form->addButton("§l§c•§f Warp §eO §c•");
			$form->addButton("§l§c•§f Warp §eP §c•");
			$form->addButton("§l§c•§f Warp §eQ §c•");
			$form->addButton("§l§c•§f Warp §eR §c•");
			$form->addButton("§l§c•§f Warp §eS §c•");
			$form->addButton("§l§c•§f Warp §eT §c•");
			$form->addButton("§l§c•§f Warp §eU §c•");
			$form->addButton("§l§c•§f Warp §eV §c•");
			$form->addButton("§l§c•§f Warp §eW §c•");
			$form->addButton("§l§c•§f Warp §eX §c•");
			$form->addButton("§l§c•§f Warp §eY §c•");
			$form->addButton("§l§c•§f Warp §eZ §c•");
			$form->sendToPlayer($sender);
			return true;
		}
	}
}