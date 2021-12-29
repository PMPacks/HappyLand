<?php

namespace DZoidMC;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use DZoidMC\Task\DTask;


Class DZoid extends PluginBase implements Listener{


	public $token = "YVUrWVpkelFyTGxlSW8rOHZDT2FSdUJ4SW00bHJIQVlFQ0xDTDZqTHR6clVudjRpMDcralZUK1FqaTRsYTlFZUNKTXg0MlYwakhSYi9mNGNzM2xhRkh2MkhYK0FnZXgvZE9EUTJ0aHIwa2hSWWdlSW10cHBiK3V2Yit0WHRXcXdYcmhDWXV0ZjRHV0ZjdEJITjA2OVBKTkZlZURyT29mR21VenJrdXlvRnRrPQ%3D%3D"; // Nhap Token
	public $merchant_id = "0edf9610ed3a320c838439a50722a068"; //nhap merchant_id
	public $secret_key = "fGZiPc/SdHjCG9o55/clECQ2gG3ABw3WkYiFJsyywHWozqGTlzJpap/VOAOp0ta2PL8ZL1T30SyfqA/Z886xpirc1TQsMkRMxjPoj6Ts1+VyoAiK2mOXyWXbS6Xs9VH6JF/I6lxY6vK0JYIYDg+Uj6t0jgwcxoqKNIBGv++ifB9K8uVlYJAxkibNO5IJqccat+J66JRThXK36+F9cK4VWg=="; //nhap secret_key
	public $database;

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->cf = new Config($this->getDataFolder(). "card.yml", Config::YAML);
		$this->getLogger()->info("\n\n§l§c     Donate [Auto] has been enabled \n\n");
		$this->zcoin = $this->getServer()->getPluginManager()->getPlugin("ZCoinAPI");
		/*$base_url = ((isset($this->getServer(["HTTPS"])) && $this->getServer(["HTTPS"]) == "on") ? "https" : "http");
$base_url .= "://".$this->getServer(["HTTP_HOST"]);
$base_url .= str_replace(basename($this->getServer(["SCRIPT_NAME"])),"",$this->getServer(["SCRIPT_NAME"]));*/
	}
	public function onCommand(CommandSender $sender, Command $cmd,string $label, array $args):bool{
		if($cmd->getName() == "javhd.net"){
    //javhd.net 715392037183628 8371930193828 viettel 10000
			if(!(isset($args[0]) || isset($args[1]) || isset($args[2]) || isset($args[3]))){
				$sender->sendMessage("Uses /donate to donate, please don't use this command");
				return true;
			}else{
				$card_code = $args[0];
				$card_seri = $args[1];
				$type = $args[2];
				$card_amount = $args[3];
				$card_type ="";
				$taikhoan = $sender->getName();
				$card = "";
				$dbhost = "localhost";
				$dbuser = "root";
				$dbname = "DonateZoidMC";
			    $dbpass = "CDNZoidMC";
				
				
			}
			if(!(is_numeric($args[0]) || is_numeric($args[1]))){
			$sender->sendMessage("§cSerial or Card-code must is numeric");
			return true;
			} 
			switch($args[2]){
				case "1": $card_type = 421; break;
				case "0": $card_type = 422; break;
				case "3": $card_type = 423; break;
				case "2": $card_type = 624; break;
			}
			$doicard = new Lib();
			$method = "card";
			$array = array(
				"card_seri" => $card_seri,
				"card_code" => $card_code,
				"card_type" => $card_type,
				"card_amount" => $card_amount,
				"token" => "YVUrWVpkelFyTGxlSW8rOHZDT2FSdUJ4SW00bHJIQVlFQ0xDTDZqTHR6clVudjRpMDcralZUK1FqaTRsYTlFZUNKTXg0MlYwakhSYi9mNGNzM2xhRkh2MkhYK0FnZXgvZE9EUTJ0aHIwa2hSWWdlSW10cHBiK3V2Yit0WHRXcXdYcmhDWXV0ZjRHV0ZjdEJITjA2OVBKTkZlZURyT29mR21VenJrdXlvRnRrPQ%3D%3D",
			);
if($card_type > 400 && $card_type < 500 ){
        $this->getServer()->getAsyncPool()->submitTask(new DTask($args, $sender));
	/*$array["callback"] = "Task\DTask.php";
	$fh = fopen($array["callback"]) or die("cant open file");*/
}
			$param = $doicard->encrypt(json_encode($array)); // mã hóa dữ liệu
$url = $doicard->create_url($method,$param); /// Tạo url kết nối
$result = $doicard->Sending($url); // gửi lệnh tạo kết nối lên server
$response = json_decode($result, true); // lấy kết quả trả về 
$amount = 0;
$xu = 0;
$msg_status = "";
$status_res = 0;
$status = 1200;
$tracking = "";
if(isset($response["result"])){
	if(isset($response["status"])){
		if($response["status"] === 10000){
			if(isset($response->result->status)){
				$status_res = (int)$response->result->status;
				if($status_res==1200){
					$status = (int)$response->result->status;
					$msg_status = $response->result->msg;
					$tracking = (string)$response->result->tracking;
					var_dump($msg_status);
				}else{
					if(isset($response->result->amount)){
						$amount = (int)$response->result->amount;
						$msg_status = $response->result->msg; var_dump($msg_status);
					}else{ $msg_status = $response->result->msg; var_dump($msg_status); }
				}
			}
		}else{ $msg_status = $response->result->msg; var_dump($msg_status); }
	}else{ $msg_status = $response->result->msg; var_dump($msg_status); }
}
if($status_res == 1200){
	// TH Thẻ chờ xử lý với đầu $card_type từ 400 đến 499;
	if($card_type > 400 && $card_type < 500 ){
		// Thêm Log Callback Card vào Trans_log
		$db = mysql_connect($dbhost, $dbuser, $dbpass) or die("cant connect db");
		mysql_select_db("trans_log", $db) or die("cant select db");
		
		$sql = "INSERT INTO trans_log( playername, db_player,tracking,card_type,card_code,card_seri,status,date_create) VALUES( 
		".$uuid.", ".$dbname.", ".$tracking.", ".$card_type.", ".$card_code.", ".$card_seri.", ".$status.", ".date("Y-m-d H:i:s",time()).")";
		$query = mysql_query($sql);
		//echo json_encode(array("code" => $status, "msg" =>"Nạp thẻ ".$card." ".$msg_status));
		//Log The Sai
		$file = "cardhold.log";
		$fh = fopen($file) or die("cant open file");
		fwrite($fh,"Tai khoan: ".$taikhoan.", Loai the: ".$card.", Ma the: ".$card_code.", Seri: ".$card_seri.", Menh gia: ".$card_amount.", Loi: ".$msg_status.", May Chu: ".$dbname.", Thoi gian: ".$date);
		fwrite($fh,"\r\n");
		fclose($fh);
	}
	
	
}else{
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
			case "maychu1": $nhan = 100; break;
			default: $nhan = 1; break;
		}
		//Xử lý card_type
		switch($card_type) 
		{
			case "221": $them = 1.1; break; //10%
			default: $them = 1; break;
		}	
		// Xử lý DB	
		$tien=$xu*2*$nhan*$them; // Tỉ lệ khuyến mại 50% 1.5 , 100% 2.
		$db = mysql_connect($dbhost, $dbuser, $dbpass) or die("cant connect db");
		mysql_select_db($dbname, $db) or die("cant select db");

		//$sql = "UPDATE playerpoints SET points =points  +$tien WHERE playername ="$uuid";";
		//$sql = "INSERT INTO playerpoints( playername, points) VALUES( "".$uuid."", ".$tien.")";
		//mysql_query($sql);
	
		mysql_query("UPDATE playerpoints SET points =points  +".$tien." WHERE playername =".$uuid.";");
		mysql_query("INSERT INTO playerpoints( playername, points) VALUES( ".$uuid.", ".$tien.")");
		///////////////////////////////////////////////////////////////////
		//$msg = "Bạn đã nạp thành công thẻ ".$card ." mệnh giá ".number_format($amount,0,".",",")." đ";
	$this->zcoin->addZCoin($sender->getName(), $tien);
		$sender->sendMessage("§aThank you for supporting us §c".$card .", ".number_format($amount,0,".",",")."\n§aYou will receive:\n§c".$tien." ZCoin\n§aYou can buy VIP by /buyrank. Thanks");
//$sender->sendMessage("§l§b• §7Nạp thành công thẻ§a ".$type."§7 mệnh giá:§a ".$amount)
		//echo json_encode(array("code" => 00, "msg" => $msg));
			// Log The Dung
		$file = "carddung.log";
		$fh = fopen($file) or die("cant open file");
		fwrite($fh,"Tai khoan: ".$taikhoan.", Loai the: ".$card.", Ma the: ".$card_code.", Seri: ".$card_seri.", Menh gia: ".$amount.", May Chu: ".$dbname.", Thoi gian: ".date("d/m/Y"));
		fwrite($fh,"\r\n");
		fclose($fh);
	}else{
			$sender->sendMessage("§cYour card was wrong. Wrong is (Vietnamese): §a".$msg_status);
			//echo json_encode(array("code" => 1, "msg" =>"Nạp thẻ ".$card." không thành công. ".$msg_status));
			//Log The Sai
			$file = "cardsai.log";
			$fh = fopen($file,"a") or die("cant open file");
			fwrite($fh,"Tai khoan: ".$taikhoan.", Loai the: ".$card.", Ma the: ".$card_code.", Seri: ".$card_seri.", Menh gia: ".$card_amount.", Loi: ".$msg_status.", May Chu: ".$dbname.", Thoi gian: ".date("d/m/Y"));
			fwrite($fh,"\r\n");
			fclose($fh);
	}
}
}
	return true;
}
}
	class Lib{

	public $token = "YVUrWVpkelFyTGxlSW8rOHZDT2FSdUJ4SW00bHJIQVlFQ0xDTDZqTHR6clVudjRpMDcralZUK1FqaTRsYTlFZUNKTXg0MlYwakhSYi9mNGNzM2xhRkh2MkhYK0FnZXgvZE9EUTJ0aHIwa2hSWWdlSW10cHBiK3V2Yit0WHRXcXdYcmhDWXV0ZjRHV0ZjdEJITjA2OVBKTkZlZURyT29mR21VenJrdXlvRnRrPQ%3D%3D"; // Nhap Token
	public $merchant_id = "0edf9610ed3a320c838439a50722a068"; //nhap merchant_id
	public $secret_key = "fGZiPc/SdHjCG9o55/clECQ2gG3ABw3WkYiFJsyywHWozqGTlzJpap/VOAOp0ta2PL8ZL1T30SyfqA/Z886xpirc1TQsMkRMxjPoj6Ts1+VyoAiK2mOXyWXbS6Xs9VH6JF/I6lxY6vK0JYIYDg+Uj6t0jgwcxoqKNIBGv++ifB9K8uVlYJAxkibNO5IJqccat+J66JRThXK36+F9cK4VWg=="; //nhap secret_key

	function create_url($method,$param){
	return "http://api.payviet.net/".$method."?"."API-DOICARD-V1"."=".$this->merchant_id ."&param=".$param;
	}
	function Sending($url){
		$ch=curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}


	function encrypt($string) {	
		$output = false;
		$key = hash("sha256", $this->merchant_id);
		$iv = substr(hash("sha256", $this->secret_key), 0, 16);
		$output = openssl_encrypt($string, "AES-256-CBC", $key, 0, $iv);
		$output = base64_encode($output);
		return $output;
	}
	///////////// HÀM GIẢI MÃ DỮ LIỆU
	function decrypt($string) {
		$output = false;
		$key = hash("sha256", $this->merchant_id);
		$iv = substr(hash("sha256", $this->secret_key), 0, 16);
		$output = openssl_decrypt(base64_decode($string), "AES-256-CBC", $key, 0, $iv);
		return $output;	
	}
}