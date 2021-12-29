<?php

namespace DZoidMC\Task;

use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use pocketmine\utils\Config;
use DZoidMC\DZoid;

class DTask extends AsyncTask
{

    public $args;
  
    public $playername;

    public function __construct($args, $sender)
    {
        $this->args = json_encode($args);
		$this->player = $sender;
        $this->playername = $sender->getName();
    }


    public function onRun(){
    if(isset($args["status"]) || !empty($args["status"])) {
	if(isset($args["card_message"]) || !empty($args["card_message"])) {
		if(isset($args["amount"]) || !empty($args["amount"])) {
			if(isset($args["tracking"]) || !empty($args["tracking"])) {
				$card_amount  = (int)$args["amount"];
				$amount  = (int)$args["amount"];
				$status  = (int)$args["status"];
				$tracking  = (string)$args["tracking"];
				$msg_status  = (string)$args["card_message"];
				var_dump($msg_status);
				$callback = json_encode($args);
				$file = "callback.log";
				$fh = fopen($file) or die("cant open file");
				
				fwrite($fh,date("Y-m-d H:i:s",time())."-callback".$callback);
				fwrite($fh,"\r\n");
				fclose($fh);
				$dbhost = "localhost";
				$dbuser = "root";
				$dbpass = "ZoidMC";
				$dbname = "DonateZoid";
				$db = mysql_connect($dbhost, $dbuser, $dbpass) or die("cant connect db");
				mysql_select_db(MYSQL_argsBASE, $db) or die("cant select db");
				$sql = "SELECT * FROM `trans_log` WHERE `tracking` = ".$tracking." and status = 1200";
				$result = mysql_query($sql);
				$new_array = array();
					if(!$result) {
					die("argsbase query failed: " . mysql_error());
				}else{
					while( $row = mysql_fetch_assoc( $result)){
						$new_array[] = $row; // Inside while loop
					}
					
					/*if(!empty($new_array)){
						$args = $new_array[0];*/
						$id_trans = (int)$args["id"];
						$card_type = (int)$args["card_type"];
						$card_code = (string)$args["card_code"];
						$card_seri = (string)$args["card_seri"];
						$uuid = $this->playername;
						$taikhoan = $this->playername;
						$dbname = $this->playername;
						$date = date("Y-m-d H:i:s",time());
						$sql_update = "UPDATE trans_log SET status = ".$status." WHERE id = ".$id_trans."";
						mysql_query($sql_update);
						mysql_close($db);
						switch($card_type) 
{
						case 1: $card = "Viettel"; break;
						case 2: $card = "Zing"; break;
						case 221: $card = "Mobile"; break;
						case 421: $card = "Viettel"; break;
						case 422: $card = "Mobile"; break;
						case 423: $card = "Vinaphone"; break;
						case 524: $card = "Gate"; break;
						case 624: $card = "Gate"; break;
						}
							if($status == 4002){
							if($amount > 0){
							switch($amount) 
							{
							case 10000: $xu = 10; break;
							case 20000: $xu = 20; break;
							case 30000: $xu = 30; break;
							case 50000: $xu= 50; break;
							case 100000: $xu = 100; break;
							case 200000: $xu = 200; break;
							case 300000: $xu = 300; break;
							case 500000: $xu = 500; break;
							case 1000000: $xu = 1000; break;
								}
								// Update Máy Chủ
								switch($dbname) 
								{
									case "daobay1": $nhan = 100; break;
									default: $nhan = 1; break;
								}
								//Xử lý card_type
								switch($card_type) 
								{
									case "221": $them = 1.1; break; //10%
									default: $them = 1; break;
								}	
								// Xử lý DB	
								$tien = $xu * 2 * $nhan * $them; // Tỉ lệ khuyến mại 50% 1.5 , 100% 2.
								$dbs = mysql_connect($dbhost, $dbuser, $dbpass) or die("cant connect db");
								mysql_select_db($dbname, $dbs) or die("cant select db");
								mysql_query("UPDATE playerpoints SET points =points  +".$tien." WHERE playername =".$uuid.";");
								mysql_query("INSERT INTO playerpoints( playername, points) VALUES( ".$uuid.", ".$tien.")");
								
								mysql_close($db);
								$this->zcoin = Server::getInstance()->getPluginManager()->getPlugin("ZCoinAPI");
								$msg = "§aThank you for supporting us §c".$amount." VND\n§aYou will receive:\n§c".$tien." ZCoin\n§aYou can buy VIP by /buyrank. Thanks";
				$sender->sendMessage(json_encode(array("code" => 00, "msg" => $msg)));
				$this->zcoin->addZCoin($sender->getName(), $tien);
									// Log The Dung
								$file = "carddung.log";
								$fh = fopen($file) or die("cant open file");
								fwrite($fh,"Tai khoan: ".$taikhoan.", Loai the: ".$card.", Ma the: ".$card_code.", Seri: ".$card_seri.", Menh gia: ".$amount.", May Chu: ".$dbname.", Thoi gian: ".$date);
								fwrite($fh,"\r\n");
								fclose($fh);
		
							}else{
						//$sender->sendMessage("§cYour card was wrong. Wrong is (Vietnamese): §a".$msg_status);
						$sender->sendMessage("§cYour card was wrong. Wrong is (Vietnamese): §a".$msg_status);
							//Log The Sai
							$file = "cardsai.log";
							$fh = fopen($file) or die("cant open file");
							fwrite($fh,"Tai khoan: ".$taikhoan.", Loai the: ".$card.", Ma the: ".$card_code.", Seri: ".$card_seri.", Menh gia: ".$card_amount.", Loi: ".$msg_status.", May Chu: ".$dbname.", Thoi gian: ".$date);
							fwrite($fh,"\r\n");
							fclose($fh);
						}
					}
					
				}
					
			}
		}
	}
	}
	}
	}