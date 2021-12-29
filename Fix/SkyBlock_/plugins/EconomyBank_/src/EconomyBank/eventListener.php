<?php

    namespace EconomyBank;


    use onebone\economyapi\EconomyAPI;
    use pocketmine\event\Listener;
    use pocketmine\event\player\PlayerLoginEvent;
    use pocketmine\event\server\DataPacketReceiveEvent;
    use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;
    use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;
    use pocketmine\plugin\Plugin;

    class eventListener implements Listener
    {
        private $plugin;

        public function __construct(Plugin $plugin)
        {
            $this->plugin = $plugin;
        }

        public function onLogin(PlayerLoginEvent $event)
        {
            $player = $event->getPlayer();
            $name = $player->getName();
            $this->plugin->money->set($name, 0);
        }

        public function onDataPacketReceive(DataPacketReceiveEvent $event)
        {
            $player = $event->getPlayer();
            $name = $player->getName();
            $receive_packet = $event->getPacket();
            if ($receive_packet instanceof ModalFormResponsePacket) {
                $formId = $receive_packet->formId;
                $formData = json_decode($receive_packet->formData, true);
                if ($formData !== null) {
                    if ($formId === $this->plugin->formId[0]) {
                        if ($formData === 0) {
                            $money = EconomyAPI::getInstance()->myMoney($player);
                            $bank_money = $this->plugin->money->get($name);
                            $packet = new ModalFormRequestPacket();
                            $form = array(
                                "type" => "custom_form",
                                "title" => "BANK",
                                "content" => array(
                                    array(
                                        "type" => "label",
                                        "text" => "§l§e⇒ §6Tiền của bạn：§b {$money}\n§e⇒ §6Tiền gửi của bạn：§b {$bank_money}",
                                    ),
                                    array(
                                        "type" => "input",
                                        "text" => "§l§b•§a Số tiền gửi",
                                    ),
                                ),
                            );
                            $packet->formData = json_encode($form);
                            $packet->formId = $this->plugin->formId[1];
                            $player->sendDataPacket($packet);
                        } else if ($formData === 1) {
                            $money = EconomyAPI::getInstance()->myMoney($player);
                            $bank_money = $this->plugin->money->get($name);
                            $packet = new ModalFormRequestPacket();
                            $form = array(
                                "type" => "custom_form",
                                "title" => "BANK",
                                "content" => array(
                                    array(
                                        "type" => "label",
                                        "text" => "Tiền của bạn： {$money}\nTiền gửi của bạn： {$bank_money}",
                                    ),
                                    array(
                                        "type" => "input",
                                        "text" => "Số tiền cần rút",
                                    ),
                                ),
                            );
                            $packet->formData = json_encode($form);
                            $packet->formId = $this->plugin->formId[2];
                            $player->sendDataPacket($packet);
                        } else if ($formData === 2) {
                            $money = EconomyAPI::getInstance()->myMoney($player);
                            $bank_money = $this->plugin->money->get($name);
                            $packet = new ModalFormRequestPacket();
                            $form = array(
                                "type" => "form",
                                "title" => "BANK",
                                "content" => "§l§e⇒ §6Tiền của bạn：§b {$money}\n§e⇒ §6Tiền gửi của bạn：§b {$bank_money}\n§a─── §bXếp hạng tiền gửi§a ───",
                                "buttons" => array(),
                            );
                            $count = 1;
                            $all_bank = $this->plugin->money->getAll();
                            foreach ($all_bank as $key => $value) {
                                $is_player = $this->plugin->getServer()->getOfflinePlayer($key);
                                if ($is_player !== null && $is_player->isOp()) {
                                    unset($all_bank[$key]);
                                }
                            }
                            arsort($all_bank);
                            foreach ($all_bank as $key => $value) {
                                $color = "§f";
                                if ($count === 1) {
                                    $color = "§l§e";
                                } else if ($count === 2) {
                                    $color = "§l§6";
                                } else if ($count === 3) {
                                    $color = "§l§7";
                                }
                                $form["content"] .= "\n{$color}{$count}§r. §a{$key}§r: §b{$value}";
                                $count++;
                            }
                            $packet->formData = json_encode($form);
                            $packet->formId = $this->plugin->formId[3];
                            $player->sendDataPacket($packet);
                        }
                    } else if ($formId === $this->plugin->formId[1]) {
                        $money = EconomyAPI::getInstance()->myMoney($player);
                        //$bank_money = $this->plugin->money->get($name);
                        $in_money = $formData[1];
                        if (is_numeric($in_money)) {
                            if ($in_money <= $money) {
                                EconomyAPI::getInstance()->reduceMoney($player, $in_money);
                                $this->plugin->money->set($name, $this->plugin->money->get($name) + $in_money);
                                $player->sendMessage(main::SUCCESS_TAG . "{$in_money} gửi tiền thành công！");
                            } else {
                                $player->sendMessage(main::ERROR_TAG . "số tiền của bạn nhập sai, vui lòng kiễm tra lại！");
                            }
                        } else {
                            $player->sendMessage(main::ERROR_TAG . "Số lượng phải là số！");
                        }
                    } else if ($formId === $this->plugin->formId[2]) {
                        //$money = EconomyAPI::getInstance()->myMoney($player);
                        $bank_money = $this->plugin->money->get($name);
                        $out_money = $formData[1];
                        if (is_numeric($out_money)) {
                            if ($out_money <= $bank_money) {
                                EconomyAPI::getInstance()->addMoney($player, $out_money);
                                $this->plugin->money->set($name, $this->plugin->money->get($name) - $out_money);
                                $player->sendMessage(main::SUCCESS_TAG . "§ađã rút thành công §6{$out_money} §aYên！");
                            } else {
                                $player->sendMessage(main::ERROR_TAG . "số tiền của bạn nhập sai, vui lòng kiễm tra lại！");
                            }
                        } else {
                            $player->sendMessage(main::ERROR_TAG . "Số lượng phải là số！");
                        }
                    }
                }
            }
        }
    }