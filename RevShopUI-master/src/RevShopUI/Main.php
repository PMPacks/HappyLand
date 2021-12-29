<?php
namespace RevShopUI;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\{Item, ItemBlock};
use pocketmine\math\Vector3;
use pocketmine\utils\TextFormat as TF;
use pocketmine\network\mcpe\protocol\PacketPool;
use pocketmine\event\server\DataPacketReceiveEvent;
use RevShopUI\Modals\elements\{Dropdown, Input, Button, Label, Slider, StepSlider, Toggle};
use RevShopUI\Modals\network\{GuiDataPickItemPacket, ModalFormRequestPacket, ModalFormResponsePacket, ServerSettingsRequestPacket, ServerSettingsResponsePacket};
use RevShopUI\Modals\windows\{CustomForm, ModalWindow, SimpleForm};
use pocketmine\command\{Command, CommandSender, ConsoleCommandSender, CommandExecutor};
use onebone\economyapi\EconomyAPI;
class Main extends PluginBase implements Listener {
public $shop;
public $item;
//documentation for setting up the items
/*
"Item name" => [item_id, item_damage, buy_price, sell_price]
*/
public $Blocks = [
"ICON" => ["Blocks",2,0],
"Oak Wood" => [17,0,30,15],
"Birch Wood" => [17,2,30,15],
"Spruce Wood" => [17,1,30,15],
"Dark Oak Wood" => [162,1,30,15],
"Cobblestone" => [4,0,10,5],
"Sand " => [12,0,15,7],
"Sandstone " => [24,0,15,7],
"Nether Rack" => [87,0,50,7],
"Glass" => [20,0,50,25],
"Glowstone" => [89,0,100,50],
"Sea Lantern" => [169,0,100,50],
"Grass" => [2,0,20,10],
"Dirt" => [3,0,10, 5],
"Stone" => [1,0,20,10],
"Planks" => [5,0,20,10],
"Prismarine" => [168,0,100,20],
"End Stone" => [121,0,30,20],
"Glass" => [20,0,50,30],
"Purpur Blocks" => [201,0,50,30],
"Quartz Block" => [155,0,100,30],
"Sea Lantern" => [169,0,100,30],
"Lapis Block" => [22,0,1000,50],
"White Wool" => [35,0,100,20],
"Stone Slab" => [44,0,100,20],
"Stone Stairs" => [67,0,100,20],
"Snow" => [80,0,500,50],
"Stone Bricks" => [98,0,500,50],
"White Stained Glass" => [160,0,500,50],
"Orange Stained Glass" => [160,1,1000,100],
"Magenta Stained Glass" => [160,2,1000,100],
"Light Blue Stained Glass" => [160,3,1000,100],
"Yellow Stained Glass" => [160,4,1000,100],
"Lime Stained Glass" => [160,5,1000,100],
"Slime Blocks" => [165,0,5000,500]
];
public $Tools = [
"ICON" => ["Tools",278,0],
"Diamond Pickaxe" => [278,0,500,250],
"Diamond Shovel" => [277,0,500,250],
"Diamond Axe" => [279,0,500,250],
"Diamond Hoe" => [293,0,500,250],
"Diamond Sword" => [276,0,750,375],
"Bow" => [261,0,400,200],
"Arrow" => [262,0,25,5]
];
public $Armor = [
"ICON" => ["Armor",311,0],
"Diamond Helmet" => [310,0,1000,0],
"Diamond Chestplate" => [311,0,2500,0],
"Diamond Leggings" => [312,0,1500,0],
"Diamond Boots" => [313,0,1000,0]
];
public $Farming = [
"ICON" => ["Farming",293,0],
"Pumpkin" => [86,0,150,10],
"Melon" => [360,13,100,7],
"Carrot" => [391,0,80,5],
"Potato" => [392,0,80,5],
"Sugarcane" => [338,0,200,15],
"Wheat" => [296,6,100,15],
"Pumpkin Seed" => [361,0,20,5],
"Melon Seed" => [362,0,20,5],
"Seed" => [295,0,20,10]
];
public $Miscellaneous = [
"ICON" => ["Miscellaneous",368,0],
"PVP Elixir" => [373,101,35000,500],
"Raiding Elixir" => [373,35000,10000,500],
"Furnace" => [61,0,20,10],
"Crafting Table" => [58,0,20,10],
"Ender Chest " => [130,0,25000,500],
"Enderpearl" => [368,0,1000,500],
"Bone" => [352,0,50,25],
"Book & Quill" => [386,0,100,0],
"Elytra" => [444,0,1000000,0],
"Boats" => [333,0,1000,500],
"Totem of Undying" => [450,0,10000000,500],
"Brewing Stand" => [117,0,20000,20],
"Carpet" => [171,0,100,5],
"White Bed" => [355,0,100,10],
"Orange Bed" => [355,1,200,20],
"Magenta Bed" => [355,2,200,20],
"Light Blue Bed" => [355,3,200,20],
"Yellow Bed" => [355,4,200,20],
"Lime Bed" => [355,5,200,20],
"Anvil" => [145,0,10000,50]
];
public $Raiding = [
"ICON" => ["Raiding",46,0],
"Flint & Steel" => [259,0,100,50],
"Torch" => [50,0,5,2],
"Packed Ice " => [174,0,1500,250],
"Water" => [9,0,500,10],
"Lava" => [10,0,1000,10],
"Redstone" => [331,0,200,25],
"Chest" => [54,0,100,50],
"TNT" => [46,0,10000,500]
];
public $Skulls = [
"ICON" => ["Skulls",397,0],
"Zombie Skull" => [397,2,500,50],
"Wither Skull" => [397,1,500,50],
"Skin Head" => [397,3,50,10],
"Creeper Skull" => [397,4,500,50],
"Dragon Skull" => [397,5,1000,60],
"Skeleton Skull" => [397,0,500,50]
];
public $Food = [
"ICON" => ["Food",364,0],
"Cooked Chicken" => [366,0,10,5],
"Steak" => [364,0,10,5],
"Golden Apple" => [322,0,500,100],
"Enchanted Golden Apple" => [466,0,1000,100]
];
public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
PacketPool::registerPacket(new GuiDataPickItemPacket());
PacketPool::registerPacket(new ModalFormRequestPacket());
PacketPool::registerPacket(new ModalFormResponsePacket());
PacketPool::registerPacket(new ServerSettingsRequestPacket());
PacketPool::registerPacket(new ServerSettingsResponsePacket());
$this->item = [$this->Blocks, $this->Tools, $this->Armor, $this->Food, $this->Farming, $this->Raiding, $this->Skulls, $this->Miscellaneous];
}
public function sendMainShop(Player $player){
$ui = new SimpleForm("§b§lDeath§Star §6Shop-Menu"," §aChọn Vật Phẩm Để Mua!");
foreach($this->item as $category){
if(isset($category["ICON"])){
$rawitemdata = $category["ICON"];
$button = new Button($rawitemdata[0]);
$button->addImage('url', "http://avengetech.me/items/".$rawitemdata[1]."-".$rawitemdata[2].".png");
$ui->addButton($button);
}
}
$pk = new ModalFormRequestPacket();
$pk->formId = 110;
$pk->formData = json_encode($ui);
$player->dataPacket($pk);
return true;
}
public function sendShop(Player $player, $id){
$ui = new SimpleForm("§b§lDeath§Star §6Shop-Menu"," §aChọn Vật Phẩm Để Mua!");
$ids = -1;
foreach($this->item as $category){
$ids++;
$rawitemdata = $category["ICON"];
if($ids == $id){
$name = $rawitemdata[0];
$data = $this->$name;
foreach($data as $name => $item){
if($name != "ICON"){
$button = new Button($name);
$button->addImage('url', "http://avengetech.me/items/".$item[0]."-".$item[1].".png");
$ui->addButton($button);
}
}
}
}
$pk = new ModalFormRequestPacket();
$pk->formId = 111;
$pk->formData = json_encode($ui);
$player->dataPacket($pk);
return true;
}
public function sendConfirm(Player $player, $id){
$ids = -1;
$idi = -1;
foreach($this->item as $category){
$ids++;
$rawitemdata = $category["ICON"];
if($ids == $this->shop[$player->getName()]){
$name = $rawitemdata[0];
$data = $this->$name;
foreach($data as $name => $item){
if($name != "ICON"){
if($idi == $id){
$this->item[$player->getName()] = $id;
$iname = $name;
$cost = $item[2];
$sell = $item[3];
break;
}
}
$idi++;
}
}
}
$ui = new CustomForm($iname);
$slider = new Slider("§dSố Lượng ",1,64,0);
$toggle = new Toggle("§5Giá");
if($sell == 0) $sell = "0";
$label = new Label(TF::GREEN."Mua: $".TF::GREEN.$cost.TF::RED."\nBán: $".TF::RED.$sell);
$ui->addElement($label);
$ui->addElement($toggle);
$ui->addElement($slider);
$pk = new ModalFormRequestPacket();
$pk->formId = 112;
$pk->formData = json_encode($ui);
$player->dataPacket($pk);
return true;
}
public function sell(Player $player, $data, $amount){
$ids = -1;
$idi = -1;
foreach($this->item as $category){
$ids++;
$rawitemdata = $category["ICON"];
if($ids == $this->shop[$player->getName()]){
$name = $rawitemdata[0];
$data = $this->$name;
foreach($data as $name => $item){
if($name != "ICON"){
if($idi == $this->item[$player->getName()]){
$iname = $name;
$id = $item[0];
$damage = $item[1];
$cost = $item[2]*$amount;
$sell = $item[3]*$amount;
if($sell == 0){
$player->sendMessage(TF::BOLD . TF::DARK_GRAY . "[" . TF::RED . "•" . TF::DARK_GRAY . "] " . TF::RESET . TF::GRAY . "§cBạn Đã Bán Sai!");
return true;
}
if($player->getInventory()->contains(Item::get($id,$damage,$amount))){
$player->getInventory()->removeItem(Item::get($id,$damage,$amount));
EconomyAPI::getInstance()->addMoney($player, $sell);
$player->sendMessage(TF::BOLD . TF::DARK_GRAY . "[" . TF::GREEN . "•" . TF::DARK_GRAY . "] " . TF::RESET . TF::GRAY . "§bBạn Đã Mua §3$amount $iname §bfor §3$$sell");
}else{
$player->sendMessage(TF::BOLD . TF::DARK_GRAY . "[" . TF::RED . "•" . TF::DARK_GRAY . "] " . TF::RESET . TF::GRAY . "§2Bạn Không Mua Được §5$amount $iname!");
}
unset($this->item[$player->getName()]);
unset($this->shop[$player->getName()]);
return true;
}
}
$idi++;
}
}
}
return true;
}
public function purchase(Player $player, $data, $amount){
$ids = -1;
$idi = -1;
foreach($this->item as $category){
$ids++;
$rawitemdata = $category["ICON"];
if($ids == $this->shop[$player->getName()]){
$name = $rawitemdata[0];
$data = $this->$name;
foreach($data as $name => $item){
if($name != "ICON"){
if($idi == $this->item[$player->getName()]){
$iname = $name;
$id = $item[0];
$damage = $item[1];
$cost = $item[2]*$amount;
$sell = $item[3]*$amount;
if(EconomyAPI::getInstance()->myMoney($player) > $cost){
$player->getInventory()->addItem(Item::get($id,$damage,$amount));
EconomyAPI::getInstance()->reduceMoney($player, $cost);
$player->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::GREEN . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::GRAY . "§bBạn Đã Mua §3$amount $iname §bVới §3$$cost §b Xu");
}else{
$player->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::GRAY . "§2Bạn Không Có Đủ Tiền Để Mua §5$amount $iname");
}
unset($this->item[$player->getName()]);
unset($this->shop[$player->getName()]);
return true;
}
}
$idi++;
}
}
}
return true;
}
public function DataPacketReceiveEvent(DataPacketReceiveEvent $event){
$packet = $event->getPacket();
$player = $event->getPlayer();
if($packet instanceof ModalFormResponsePacket){
$id = $packet->formId;
$data = $packet->formData;
$data = json_decode($data);
if($data === Null) return true;
if($id === 110){
$this->shop[$player->getName()] = $data;
$this->sendShop($player, $data);
return true;
}
if($id === 111){
//$this->shop[$player->getName()] = $data;
$this->sendConfirm($player, $data);
return true;
}
if($id === 112){
$selling = $data[1];
$amount = $data[2];
if($selling){
$this->sell($player, $data, $amount);
return true;
}
$this->purchase($player, $data, $amount);
return true;
}
}
return true;
}
public function onCommand(CommandSender $player, Command $command, string $label, array $args) : bool{
switch(strtolower($command)){
case "shop":
$this->sendMainShop($player);
return true;
}
}
}
