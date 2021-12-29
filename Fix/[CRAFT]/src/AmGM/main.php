<?php
namespace AmGM;

use pocketmine\item\ItemIds;
use pocketmine\inventory\ShapedRecipe;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\entity\Effect;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\math\Vector3;
use pocketmine\level\particle\{AngryVillagerParticle,BubbleParticle,CriticalParticle,DestroyBlockParticle,DustParticle,EnchantmentTableParticle,EnchantParticle,EntityFlameParticle,LargeExplodeParticle,FlameParticle,HappyVillagerParticle,HeartParticle,InkParticle,InstantEnchantParticle,ItemBreakParticle,LavaDripParticle,LavaParticle,MobSpellParticle,PortalParticle,RainSplashParticle,RedstoneParticle,SmokeParticle,SpellParticle,SplashParticle,SporeParticle,TerrainParticle,WaterDripParticle,WaterParticle,WhiteSmokeParticle};
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

class main extends PluginBase implements Listener {

    public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $recipe = new ShapedRecipe(["A A","A A","A A"], ["A" => Item::get(ItemIds::IRON_PICKAXE,0,1) ], [$this->CupEnchant()]);
    $this->getServer()->getCraftingManager()->registerShapedRecipe($recipe);
    $this->getServer()->getCraftingManager()->buildCraftingDataCache();
    //Item::addCreativeItem($this->CupEnchant());
    }
    private function CupEnchant() : Item{
    //public function CupEnchant(){
    $ocean = Item::get(257, 0, 1);
	$ecocean1 = Enchantment::getEnchantment(15);
	$ei1 = new EnchantmentInstance($ecocean1,25);
    $ecocean2 = Enchantment::getEnchantment(17);
    $ei2 = new EnchantmentInstance($ecocean2,8);
    $ocean->addEnchantment($ei1);
    $ocean->addEnchantment($ei2);
	$ocean->setCustomName("§l§bC§6ú§ep§b Ocean\n");
    return $ocean;
    }
   }