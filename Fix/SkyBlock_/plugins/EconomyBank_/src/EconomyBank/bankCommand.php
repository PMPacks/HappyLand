<?php

    namespace EconomyBank;

    use onebone\economyapi\EconomyAPI;
    use pocketmine\command\Command;
    use pocketmine\command\CommandSender;
    use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;
    use pocketmine\Player;
    use pocketmine\plugin\Plugin;

    class bankCommand extends Command
    {

        private $plugin;

        public function __construct(Plugin $plugin)
        {
            $this->plugin = $plugin;
            parent::__construct("bank", "OpenBank", "/bank");
            $this->setPermission("economybank.command.bank");
        }

        public function execute(CommandSender $sender, string $commandLabel, array $args): bool
        {
            $name = $sender->getName();
            if (!$sender instanceof Player) {
                $sender->sendMessage(main::ERROR_TAG . "Lệnh này chỉ có thể được thực thi bởi người chơi。");
                return true;
            }
            $money = EconomyAPI::getInstance()->myMoney($sender);
            $bank_money = $this->plugin->money->get($name);
            $packet = new ModalFormRequestPacket();
            $form = array(
                "type" => "form",
                "title" => "§l§eNgân Hàng",
	"content" => "§l§e⇒ §6Tiền của bạn：§b {$money}\n§e⇒ §6Tiền gửi của bạn：§b {$bank_money}",
                "buttons" => array(
                    array(
                        "text" => "§l§1• §6Gửi tiền§1 •",
                    ),
                    array(
                        "text" => "§l§1• §6Rút tiền§1 •",
                    ),
                    array(
                        "text" => "§l§1• §aXếp hạng§1 •",
                    ),
                ),
            );
            $packet->formData = json_encode($form);
            $packet->formId = $this->plugin->formId[0];
            $sender->sendDataPacket($packet);
            return true;
        }

    }