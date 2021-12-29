<?php

    namespace EconomyBank;

    use pocketmine\plugin\PluginBase;
    use pocketmine\utils\Config;

    class main extends PluginBase
    {
        public $money;
        public $formId;
        const SUCCESS_TAG = "§b[§6 BANK §b] §aSuccess §a>> §r";
        const ERROR_TAG = "§b[§6 BANK §b] §4ERROR §a>> §r";

        public function onEnable(): void
        {
            $this->getLogger()->info("Đã được tải");
            $this->getServer()->getPluginManager()->registerEvents(new eventListener($this), $this);
            $this->getServer()->getCommandMap()->register("bank", new bankCommand($this));
            if (!file_exists($this->getDataFolder())) {
                mkdir($this->getDataFolder(), 0777);
            }
            $this->money = new Config($this->getDataFolder() . "money.yml", Config::YAML);
            $this->formId[0] = mt_rand(50000, 100000);
            $this->formId[1] = mt_rand(50000, 100000);
            $this->formId[2] = mt_rand(50000, 100000);
            $this->formId[3] = mt_rand(50000, 100000);
            $this->getScheduler()->scheduleRepeatingTask(new saveTask($this), 20 * 60 * 5);//5分ごと
        }

        public function onDisable(): void
        {
            $this->money->save();
            $this->getLogger()->info("Đã tắt");
        }
    }